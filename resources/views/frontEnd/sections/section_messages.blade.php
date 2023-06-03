<style type="text/css">
    .event_about_area img{
    width:100%; 
  max-height:600px;  
  
}
.titlecontent{
    margin-bottom:20px; 
}
 
@media(min-width:600px){
    .event_about_area img{ 
  margin-top:50px; 
}
}
</style>
 <section class="event_about_area">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
          <h2 class="wow fadeInUp titlecontent">  {{ $title }}</h2>
            <div class="col-lg-8">
                <div class="event_about_content">
                    
                    
                        
                        {!! $Topic->$details_var !!}
                   
                   
                </div>
            </div>
              <div class="col-lg-4">
                <div class="event_about_img">
                    <img class="wow fadeInRight" data-wow-delay="0.2s" src="{{ Helper::FilterImage($Topic->photo_file) }}" alt="" />
                {{--     <div class="about_bg"></div> --}}
                </div>
            </div>
            <div class="col-md-12">
              

            </div>
        </div>
    </div>
</section>