<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class ProjectsTest extends TestCase
{
    use WithFaker,RefreshDatabase;
   
    public function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );
    }

   /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $attributes =[
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph()
        ]; 


       $this->post('/projects',$attributes);
       
       $this->assertDatabaseHas('projects',$attributes);

       $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    
    public function a_project_requires_title()
    {
        $attributes = Project::factory()->raw(['title' =>'' ]);
        $this->post('/projects',$attributes)->assertSessionHasErrors('title');
        
    }

     /** @test */
    
     public function a_project_requires_description()
     {
 
        $attributes = Project::factory()->raw(['description' =>'' ]);
         $this->post('/projects',$attributes)->assertSessionHasErrors('description');
         
     }


      /** @test */
    
      public function a_user_can_view_a_project()
      {
        $this->withoutExceptionHandling();
            $project =   Project::factory()->create();
             $this->get($project->path())->assertSee('title')->assertSee('description');

            
          
      }


}
