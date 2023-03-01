<?php

namespace App\Http\Controllers;

use App\Services\ToDoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ToDoListController extends Controller
{
    /**
     * @var ToDoService
     */
    private $toDoService;

    /**
     * Set constructor function
     */
    public function __construct(ToDoService $toDoService)
    {
        $this->toDoService = $toDoService;
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return $this->toDoService->getLoggedInUserToDoList();
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('to-do.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        return $this->toDoService->storeToDoList($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        return $this->toDoService->showToDo($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return $this->toDoService->editToDo($id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        return $this->toDoService->updateToDo($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        return $this->toDoService->deleteToDo($id);
    }

    /**
     * To-Do list wise tasks
     * @param $id
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function toDoTasks($id)
    {
        return $this->toDoService->toDoTaskList($id);
    }

    /**
     * Redirect to manage task form
     * @param $id
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function manageTask($id)
    {
        return $this->toDoService->manageTask($id);
    }

    /**
     * Update to-do tasks using to update methods
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function updateTasks(Request $request, $id)
    {
        return $this->toDoService->updateToDoTasks($request,$id);
    }

    /**
     * Add new task on to-do
     * @param $id
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function addTask($id)
    {
        return $this->toDoService->addTaskForm($id);
    }

    /**
     * Store new tasks on specific to-do list
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function storeTask(Request $request, $id): RedirectResponse
    {
        return $this->toDoService->storeTaskOnToDo($request,$id);
    }

    /**
     * Edit task form
     * @param $id
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function editTask($id)
    {
        return $this->toDoService->editTask($id);
    }

    /**
     * Update task
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function updateTask(Request $request, $id)
    {
        return $this->toDoService->updateTask($request, $id);
    }

    /**
     * Delete a specific task
     * @param $id
     * @return RedirectResponse
     */
    public function deleteTask($id)
    {
        return $this->toDoService->deleteTask($id);
    }
}
