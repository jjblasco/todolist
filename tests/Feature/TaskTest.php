<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private function task()
    {
        return Task::factory()->make()->toArray();
    }

    public function testCallToTaskView() :void
    {
        $response = $this->get('/');
        $response->assertViewIs('tasks');

    }

    public function testGetTask() :void
    {
        $response = $this->get('/api/tasks');
        $response->assertOk();

    }

    public function testAddNewTask() :void
    {
        $response = $this->post('/api/task/store', [
            'task' => [
                'name' => 'probando testing'
                ]
        ]);

        $response->assertCreated();

    }

    public function testFailedIfDontFindTaskToUpdate() :void
    {
        $response = $this->put('/api/task/'. 1);
        $response->assertOk();
        $this->assertEquals($response->content(), 'Task not found');
    }

    public function testUpdateTaskPendingToStarted() :void
    {
        $task = $this->addTask();

        $response = $this->put('/api/task/'. $task[0]->id, [
            'task' => [
                'statusTask' => 'pending'
            ]
        ]);
        $response->assertOk();
        $this->assertEquals(Task::find($task[0]->id)->statusTask, 'started');

    }

    public function testUpdateTasktartedToDone() :void
    {

        $task = $this->addTask();

        $response = $this->put('/api/task/'. $task[0]->id, [
            'task' => [
                'statusTask' => 'started'
            ]
        ]);
        $response->assertOk();
        $this->assertEquals(Task::find($task[0]->id)->statusTask, 'done');

    }

    public function testUpdateTaskDoneToPending() :void
    {

        $task = $this->addTask();

        $response = $this->put('/api/task/'. $task[0]->id, [
            'task' => [
                'statusTask' => 'done'
            ]
        ]);
        $response->assertOk();
        $this->assertEquals(Task::find($task[0]->id)->statusTask, 'pending');

    }

    public function testFailedIfDontFindTaskToDelete() :void
    {
        $response = $this->delete('/api/task/'. 1);
        $response->assertOk();
        $this->assertEquals($response->content(), 'Task not found');
    }

    public function testDeleteTask() :void
    {
        $task = $this->addTask();
        $response = $this->delete('/api/task/'. $task[0]->id);
        $response->assertOk();
        $this->assertEquals($response->content(), 'Task deleted');
    }

    public function addTask()
    {
        $this->post('/api/task/store', [
            'task' => [
                'name' => 'probando testing'
                ]
        ]);

        $task = Task::where('name','probando testing')->get();

        return $task;

    }
}
