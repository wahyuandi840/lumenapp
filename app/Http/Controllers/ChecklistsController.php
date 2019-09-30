<?php

namespace App\Http\Controllers;

class ChecklistsController extends Controller 
{
    private $data = '{
        "data": {
          "type": "checklists",
          "id": 1,
          "attributes": {
            "object_domain": "contact",
            "object_id": "1",
            "description": "Need to verify this guy house.",
            "is_completed": false,
            "due": null,
            "urgency": 0,
            "completed_at": null,
            "last_update_by": null,
            "update_at": null,
            "created_at": "2018-01-25T07:50:14+00:00"
          },
          "links": {
            "self": "https://dev-kong.command-api.kw.com/checklists/50127"
          }
        }
    }';
    
    
    private $res_404='{
        "status": "404",
        "error": "Not Found"
    }';
    
    
    private $res_500='{
        "status": "500",
        "error": "Server Error"
    }';
    
    private $res_add_data='{
        "data": {
          "type": "checklists",
          "id": "1",
          "attributes": {
            "object_domain": "contact",
            "object_id": "1",
            "task_id": "123",
            "description": "Need to verify this guy house.",
            "is_completed": false,
            "due": "2019-01-19T18:34:51+00:00",
            "urgency": "2",
            "completed_at": null,
            "updated_by": null,
            "created_by": 556396,
            "created_at": "2019-04-12T14:13:42+00:00",
            "updated_at": "2019-04-12T14:13:42+00:00"
          },
          "links": {
            "self": "http://localhost:8000/api/v1/checklists/1547"
          }
        }
    }';
    
    public function showChecklistById($id)
    {
        try{
            if($id==1){
                $data= json_decode($this->data,true);
                
                return response($data, 200);
            } else {
                
                $responseData=json_decode($this->res_404,true);
                return $this->show404($responseData);
            }
        } catch (Exception $ex) {
            
            $responseData=json_decode($this->res_500,true);
            return $this->show500($responseData);
        }
    }
    
    public function updateChecklistById(\Illuminate\Http\Request $request,$id)
    {
        try{
            
            if($id==1){
                $input=$request->all();
        
                $data=json_decode($this->data,true);
                $atributes=$data['data']['attributes'];
                $atributesInput=$input['data']['attributes'];
                
                $atributes['description']=$atributesInput['description'];
                
                $data['data']['attributes']=$atributes;
                
               
                return response($data, 200);
            } else {
                $responseData=json_decode($this->res_404,true);
                return $this->show404($responseData);
            }
            
        } catch (Exception $ex) {
            $responseData=json_decode($this->res_500,true);
            return $this->show500($responseData);
        }
        
        
        
    }

    public function deleteChecklistById(\Illuminate\Http\Request $request,$id)
    {
        try{
            
            if($id==1){  
               
                return response('', 204);
            } else {
                $responseData=json_decode($this->res_404,true);
                return $this->show404($responseData);
            }
            
        } catch (Exception $ex) {
            $responseData=json_decode($this->res_500,true);
            return $this->show500($responseData);
        }
        
        
        
    }
    
    public function addChecklist(\Illuminate\Http\Request $request)
    {
        try{
            
            $input=$request->all();
        
            $data=json_decode($this->res_add_data,true);
            $atributes=$data['data']['attributes'];
            $atributesInput=$input['data']['attributes'];

            $atributes['description']=$atributesInput['description'];

            $data['data']['attributes']=$atributes;
                
               
            return response($data, 201);
            
        } catch (Exception $ex) {
            $responseData=json_decode($this->res_500,true);
            return $this->show500($responseData);
        }
        
        
        
    }

    private function  show404(array $responseData)
    {
        return response()->json($responseData, 404);
        
    }
    
    private function show500(array $responseData)
    {
        return response()->json($responseData, 500);
    }
    
}

