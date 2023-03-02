<?php

namespace App\Services;
use App\Models\Task;
use App\Models\ToDoList;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class ToDoService.
 */
class ToDoService
{
    /**
     * Get logged-in user to do list
     * @return Application|Factory|View
     */
    public function getLoggedInUserToDoList()
    {
        $list = ToDoList::query();
        $list->where('user_id',Auth::id());
        $to_do_lists = $list->paginate(10);
        return view('to-do.index',compact('to_do_lists'));
    }

    /**
     * Store a newly created to do list
     * @param $request
     * @return RedirectResponse
     */
    public function storeToDoList($request)
    {
        $to_do = new ToDoList();
        $to_do->user_id = Auth::id();
        $to_do->name = $request->name;
        if($to_do->save()) {
            if(isset($request->task_name) AND sizeof($request->task_name) > 0) {
                foreach ($request->task_name as $key => $task) {
                    $task = new Task();
                    $task->to_do_list_id = $to_do->id;
                    $task->task_name = $request->task_name[$key];
                    $task->task_description = $request->task_description[$key] ?? null;
                    $task->save();
                }
            }
            return redirect()
                ->route('to-do-list.index')
                ->with([
                    'type' => 'success',
                    'message' => 'New To-Do has been added successfully on list'
                ]);
        } else {
            return redirect()
                ->back()
                ->with('message','Data not saved.Something wrong!');
        }
    }

    /**
     * Fetch to-do list wise tasks
     * @param $id
     * @return Application|Factory|View
     */
    public function toDoTaskList($id)
    {
        $to_do = $this->toDoDetails($id);
        return view('to-do.task_list',compact('to_do'));
    }

    /**
     * Redirect to edit to-do form
     * @param $id
     * @return Application|Factory|View
     */
    public function editToDo($id)
    {
        $to_do = $this->toDoDetails($id);
        return view('to-do.edit',compact('to_do'));
    }

    /**
     * Update to-do list
     * @param $request
     * @param $id
     * @return RedirectResponse
     */
    public function updateToDo($request, $id)
    {
        $to_do = ToDoList::findOrFail(encryptDecrypt($id,'decrypt'));
        $to_do->name = $request->name ?? $to_do->name;
        if($to_do->save()) {
            $currentTasks = Task::where('to_do_list_id',$to_do->id)->pluck('id')->toArray() ?? [];
            $requestTasks = array_map('intval',$request->task_id ?? []) ?? [];
            // Remove deleted task from to-do list
            $deletedRows  = array_merge(array_diff($currentTasks, $requestTasks), array_diff($requestTasks, $currentTasks));
            Task::whereIn('id',$deletedRows)->delete();
            // Store/Update task on to-do list
            if(isset($request->task_name) AND sizeof($request->task_name) > 0) {
                foreach ($request->task_name as $key => $task) {
                    $identify = ['id' => $requestTasks[$key] ?? null];
                    $data = [
                        'to_do_list_id' => $to_do->id,
                        'task_name' => $request->task_name[$key],
                        'task_description' => $request->task_description[$key] ?? null,
                    ];
                    Task::updateOrInsert($identify, $data);
                }
            }
            return redirect()
                ->route('to-do-list.index')
                ->with([
                    'type' => 'info',
                    'message' => 'To-Do has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->with('message','Data not saved.Something wrong!');
        }
    }

    /**
     * Display a specific to-do from list
     * @param $id
     * @return Factory|Application|View
     */
    public function showToDo($id)
    {
        $to_do = $this->toDoDetails($id);
        return view('to-do.details',compact('to_do'));
    }

    /**
     * Delete single to-do from list
     * @param $id
     * @return RedirectResponse
     */
    public function deleteToDo($id)
    {
        // Delete tasks first
        Task::whereIn('to_do_list_id',array(encryptDecrypt($id,'decrypt')))->delete();
        // Delete to-do
        ToDoList::findOrFail(encryptDecrypt($id,'decrypt'))->delete();
        return redirect()
            ->route('to-do-list.index')
            ->with([
                'type' => 'danger',
                'message' => 'To-Do has been deleted successfully from list'
            ]);
    }

    /**
     * Get to-do by id
     * @param $id
     * @return mixed
     */
    public function toDoDetails($id)
    {
        return ToDoList::findOrFail(encryptDecrypt($id,'decrypt'));
    }

    /**
     * Redirect to manage tasks form
     * @param $id
     * @return Application|Factory|View
     */
    public function manageTask($id)
    {
        $to_do = $this->toDoDetails($id);
        return view('to-do.manage_task',compact('to_do'));
    }

    /**
     * Redirect to add tasks form on a to-do
     * @param $id
     * @return Application|Factory|View
     */
    public function addTaskForm($id)
    {
        $to_do = $this->toDoDetails($id);
        return view('to-do.add_tasks',compact('to_do'));
    }

    /**
     * Handle new tasks request on a to-do list
     * @param $request
     * @param $id
     * @return RedirectResponse
     */
    public function storeTaskOnToDo($request,$id)
    {
        if(isset($request->task_name) AND sizeof($request->task_name) > 0) {
            foreach ($request->task_name as $key => $task) {
                $task = new Task();
                $task->to_do_list_id = encryptDecrypt($id,'decrypt');
                $task->task_name = $request->task_name[$key];
                $task->task_description = $request->task_description[$key] ?? null;
                $task->save();
            }
        }
        return redirect()
            ->route('to-do-tasks',$id)
            ->with([
                'type' => 'success',
                'message' => 'New Tasks has been added successfully on To-Do list'
            ]);
    }

    /**
     * Update to-do tasks
     * @param $request
     * @param $id
     * @return RedirectResponse
     */
    public function updateToDoTasks($request, $id)
    {
        return $this->updateToDo($request,$id);
    }

    /**
     * Redirect to edit task form
     * @param $id
     * @return Application|Factory|View
     */
    public function editTask($id)
    {
        $task = Task::findOrFail(encryptDecrypt($id,'decrypt'));
        return view('to-do.edit_task',compact('task'));
    }

    /**
     * Handle update task request
     * @param $request
     * @param $id
     * @return RedirectResponse
     */
    public function updateTask($request,$id)
    {
        $task = Task::findOrFail(encryptDecrypt($id,'decrypt'));
        $task->task_name = $request->task_name;
        $task->task_description = $request->task_description;
        if($task->save()) {
            return redirect()
                ->route('to-do-tasks',encryptDecrypt($task->to_do_list_id,'encrypt'))
                ->with([
                    'type' => 'info',
                    'message' => 'Task has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->with('message','Data not saved.Something wrong!');
        }
    }

    /**
     * Delete a specific task
     * @param $id
     * @return RedirectResponse
     */
    public function deleteTask($id)
    {
        $task = Task::findOrFail(encryptDecrypt($id,'decrypt'));
        $task->delete();
         return redirect()
             ->route('to-do-tasks',encryptDecrypt($task->to_do_list_id,'encrypt'))
            ->with([
                'type' => 'danger',
                'message' => 'Task has been deleted successfully'
            ]);
    }
}
