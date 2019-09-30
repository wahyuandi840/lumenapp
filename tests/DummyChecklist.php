<?php

class DummyChecklist {

    public $data = '{
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
    
    
    public $res_404='{
        "status": "404",
        "error": "Not Found"
    }';
    
    
    public $res_500='{
        "status": "500",
        "error": "Server Error"
    }';
    

}
