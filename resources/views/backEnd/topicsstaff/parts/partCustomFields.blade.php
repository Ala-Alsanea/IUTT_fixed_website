<?php

       $contentNameOfField="";

          if ($WebmasterSection->name=='admissioncontent') {      
           // dd($WebmasterSection);
                     if (isset($Topic->fields) && isset($Topic->fields[0])) {
                         $NameOfField= Helper::GetNameOfFields($Topic->fields[0]->field_id,$Topic->fields[0]->field_value);
               
                         if ($NameOfField['name_custom']!='') {
                             $contentNameOfField = "<span style='color:#4e7bef;'>".$NameOfField['title']."[" .$NameOfField['name_custom']."]</span>";
                         }
                       

                     }
             
                     if (isset($Topic->fields) && isset($Topic->fields[1])) {
                         $NameOfField= Helper::GetNameOfFields($Topic->fields[1]->field_id,$Topic->fields[1]->field_value);

                         if ($NameOfField['name_custom']!='') {
                             $contentNameOfField=$contentNameOfField. "&nbsp;&nbsp;<span style='color:#444e0f;'>".$NameOfField['title']."[" .$NameOfField['name_custom']."]</span>";
                         }
                       

                     }
            }elseif($WebmasterSection->name=='contentprograms') {
                      if (isset($Topic->fields) && isset($Topic->fields[0])) {
                         $NameOfField= Helper::GetNameOfFields($Topic->fields[0]->field_id,$Topic->fields[0]->field_value);

                         if ($NameOfField['name_custom']!='') {
                             $contentNameOfField="<span style='color:#444e0f;'>".$NameOfField['title']."[" .$NameOfField['name_custom']."]</span>";
                         }
                       

                     }

           }elseif($WebmasterSection->name=='section_quik_icon') {
                                   
               if (isset($Topic->fields) && isset($Topic->fields[0])) {
                         $NameOfField= Helper::GetNameOfFields($Topic->fields[0]->field_id,$Topic->fields[0]->field_value);

                         if ($NameOfField['name_custom']!='') {
                             $contentNameOfField="<span style='color:#4e7bef;'>".$NameOfField['title']."[" .$NameOfField['name_custom']."]</span>";
                         }
                       

                     }


                       
         }elseif($WebmasterSection->name=='academycalendar') {
                                   
               if (isset($Topic->fields) && isset($Topic->fields[2])) {
                         $NameOfField= Helper::GetNameOfFields($Topic->fields[2]->field_id,$Topic->fields[2]->field_value);

                         if ($NameOfField['name_custom']!='') {
                             $contentNameOfField="<span style='color:#4e7bef;'>".$NameOfField['title']."[" .$NameOfField['name_custom']."]</span>";
                         }
                       

                     }


                       
         
   }elseif($WebmasterSection->name=='lecturertable') {
                                   
               if (isset($Topic->fields) && isset($Topic->fields[0])) {
                         $NameOfField= Helper::GetNameOfFields($Topic->fields[0]->field_id,$Topic->fields[0]->field_value);

                         if ($NameOfField['name_custom']!='') {
                             $contentNameOfField="<span style='color:#4e7bef;'>".$NameOfField['title']."[" .$NameOfField['name_custom']."]</span>";
                         }
                       

                     }


                       
        }elseif($WebmasterSection->name=='contentsdepartment') {
                                   
               if (isset($Topic->fields) && isset($Topic->fields[0])) {
                         $NameOfField= Helper::GetNameOfFields($Topic->fields[0]->field_id,$Topic->fields[0]->field_value);

                         if ($NameOfField['name_custom']!='') {
                             $contentNameOfField="<span style='color:#4e7bef;'>".$NameOfField['title']."[" .$NameOfField['name_custom']."]</span>";
                         }
                       

                     }


                       
      

        }elseif($WebmasterSection->name=='academicstaff') {
                                   
               if (isset($Topic->fields) && isset($Topic->fields[19])) {
                         $NameOfField= Helper::GetNameOfFields($Topic->fields[19]->field_id,$Topic->fields[19]->field_value);

                         if ($NameOfField['name_custom']!='') {
                             $contentNameOfField="<span style='color:#4e7bef;'>".$NameOfField['title']."[" .$NameOfField['name_custom']."]</span>";
                         }
                       

                     }


                       
         }

      echo $contentNameOfField;