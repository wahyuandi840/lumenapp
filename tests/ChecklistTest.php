<?php

include_once 'DummyChecklist.php';

class ChecklistTest extends TestCase 
{
    private $dummy;
    
    public function setUp() :void 
    {
        parent::setUp();
        $this->dummy=new DummyChecklist();
    }
    

    private function check404()
    {
        
        $resp= json_decode($this->dummy->res_404,true);
        $this->seeStatusCode(404);
        $this->seeJsonEquals($resp);
    }
    
    private function check500()
    {
        
        $resp= json_decode($this->dummy->res_500,true);
        $this->seeStatusCode(500);
        $this->seeJsonEquals($resp);
    }
    
    /**
     * /checklists/{checklistId} [GET]
     */
    public function testGetChecklist()
    {
        
        $data= json_decode($this->dummy->data,true);
        $this->get('/checklists/1');
        $this->seeStatusCode(200);
        $this->seeJsonEquals($data);
        
    }
    
    /**
     * /checklists/{checklistId} [GET]
     * response 404
     */   
    public function testGetChecklist404()
    {
        $this->get('/checklists/9999999999999999999');
        $this->check404();
    }
    
    /**
     * /checklists/{checklistId} [PATCH]
     */
    public function testUpdateCheklist()
    {
        $data= json_decode($this->dummy->data,true);
        unset($data['data']['attributes']);
        $data['data']['attributes']=array(
            "object_domain"=> "contact",
            "object_id"=> "1",
            "description"=> "Cobay Ya.",
            "is_completed"=> false,
            "completed_at"=> null,
        );
        
        $this->patch('/checklists/1', $data);
        
        $this->seeJsonContains($data['data']['attributes']);        
    }
    
    /**
     * /checklists/{checklistId} [DELETE]
     */
    public function testDeleteCheklist()
    {
        $this->delete('/checklists/1');
        $this->seeStatusCode(204);
    }
    
    /**
     * /checklists [POST]
     */
    
    public function testAddCheklist()
    {
        
        $data= json_decode($this->dummy->data,true);
        unset($data['data']['attributes']);
        unset($data['data']['type']);
        unset($data['data']['id']);
        $data['data']['attributes']=array(
            "object_domain"=> "contact",
                "object_id"=> "1",
                "due"=> "2019-01-25T07:50:14+00:00",
                "urgency"=> 1,
                "description"=> "Need to verify this guy house.",
                "items"=> [
                  "Visit his house",
                  "Capture a photo",
                  "Meet him on the house"
                ],
                "task_id"=> "123"
        );
        
        $this->post('/checklists',$data);
        
        $this->seeStatusCode(201);
    }
}

