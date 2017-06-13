$sub_num = 1;
        function more(){    
          if($sub_num<10){
            $sub_num = $sub_num + 1; 
            
            var obj = document.getElementById('story-list');
            
            var story_div = document.createElement('div');
            var story-tool_div = document.createElement('div');
            var story-tool-off_div = document.createElement('div');
            var story-content_div=document.createElement('div');
            var story-picture_div=document.createElement('div');
            var story-inner_div=document.createElement('div');
            var story-name_div=document.createElement('div');
            var story-block_div=document.createElement('div');
            var story-URL_div=document.createElement('div');
     
            
            
            story_div.id='story';
            story-tool_div.id='story-tool';
            story-tool-off_div.id='story-tool-off';
            story-content_div.id='story-content';
            story-picture_div.id='story-picture';
            story-inner_div.id='story-inner';
            story-name_div.id='story-name';
            story-block_div.id='story-block';
            story-URL_div.id='story-URL';
            
            story.appendChild(story-tool);
            story.appendChild(story-content);
            story-tool.appendChild(story-tool-off);
            story-content.appendChild(story-picture);
            story-content.appendChild(story-inner);
            story-inner.appendChild(story-name);
            story-inner.appendChild(story-block);
            story-inner.appendChild(story-URL);
            
            obj.appendChild(story_div);
          }           
        }