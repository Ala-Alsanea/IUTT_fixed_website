          <div class="main-detail main-detail-8" style="display: none;">
                @if(count($FacultyData->departments)>0)
<style type="text/css">
  .grid {
    position: relative;
    margin: 0 auto;
    list-style: none;
    text-align: center;
}
.grid figure {
    position: relative;
 
    overflow: hidden;
    margin: 0;
    width: 100%;
    text-align: center;
    cursor: pointer;
    margin-bottom:10px; 
    /* direction: rtl; */
}

div#program_img img {
    width: 100%;
   
    margin-bottom: 5%;
}

@media (min-width:700px) {
  div#program_img img {
 
    height:200px; 
  
}
}
.grid figure img {
    position: relative;
    display: block;
    max-width: 101%;
    opacity: 1;
}

figure.effect-oscar figcaption {
    padding: 15%;
}
.grid figure figcaption, .grid figure figcaption > a {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.grid figure figcaption {
    padding: 2em;
    color: #fff;
    text-transform: uppercase;
    font-size: 1.25em;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}
.grid figure figcaption h2,.grid figure figcaption p{
    color: #fff;
}
.grid figure figcaption::before, .grid figure figcaption::after {
    pointer-events: none;
}
figure.effect-oscar figcaption::before {
    position: absolute;
    top: 30px;
    right: 30px;
    bottom: 30px;
    left: 30px;
    border: 1px solid #fff;
    content: '';
}
figure.effect-oscar figcaption::before, figure.effect-oscar p {
    opacity: 0;
    -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
    transition: opacity 0.35s, transform 0.35s;
    -webkit-transform: scale(0);
    transform: scale(0);
 
    padding-top:10%;
}





.grid figure h2, .grid figure p {
    margin: 0;
}
.grid figure h2 {
    word-spacing: -0.15em;
    font-weight: 700;
}

figure.effect-oscar h2 {
    margin: 0;
    line-height: 1em;
    -webkit-transition: -webkit-transform 0.35s;
    transition: transform 0.35s;
    -webkit-transform: translate3d(0,100%,0);
    transform: translate3d(0,100%,0);
}

div#program_img h2 {
    display: none;
    font-size: 14px;
}



.grid figure p {
    letter-spacing: 1px;
    font-size: 68.5%;
 
    margin-bottom: 10px;
}
 
 
figure.effect-oscar.wowload.fadeInUp h3 {
    background: #eee;
    padding: 8% 3% 5% 3%;
    margin-top: -15px;
    min-height: 60px;
    font-size:18px !important; 
}
figure.effect-oscar:hover img {
    opacity: 0.4;
}

figure.effect-oscar:hover figcaption {
    background-color: rgba(33,171,202,0.7);
}
figure.effect-oscar figcaption {
    padding: 15%;
}

figure.effect-oscar:hover figcaption::before, figure.effect-oscar:hover p {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}

div#program_img:hover h2 {
    display: block;
}

figure.effect-oscar:hover figcaption::before, figure.effect-oscar:hover p {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
figure.effect-oscar.wowload.fadeInUp h3 {
    background: #eee;
    padding: 8% 3% 5% 3%;
    margin-top: -15px;
    min-height: 60px;
}
figure:hover h3 {
    color: #eee;
}

div#program_img a {
    border: 1px solid #fff;
    margin-top: 1em;
    display: inline-block;
    color: #fff;
    padding:2px 10px;
}
figure.effect-oscar.wowload.fadeInUp h3 {
    background: #eee;
    padding: 8% 3% 5% 3%;
    margin-top: -15px;
    min-height: 60px;
    font-size:16px !important; 
    font-weight: 700;
}
</style>
 
 
   
            <div class="row">
                   @foreach($FacultyData->departments as $key => $Item)
                   <div class="col-md-4 col-sm-6"> 
                   <div id="program_img" class=" clearfix grid">
<figure class="effect-oscar  wowload fadeInUp">
<img src="{{ Helper::FilterImage($Item->photo_file) }}" border="0" alt="{{ $Item->$title_var }}">
<figcaption>
<h2>{{ $Item->$title_var }}</h2> 
<p>{{ str_limit(strip_tags($Item->$details_var), $limit =50, $end = '...') }}
<br>
<a href="{{ url(trans('backLang.boxCode').'/'.$FacultyData->$title_var.'/departments/'.$Item->id) }}" title="{{ $Item->$title_var }}">{{ trans('frontLang.readMore') }}</a></p> 
</figcaption>
<h3>{{ $Item->$title_var }}</h3> </figure></div>

          </div>
               
                     @endforeach
           
             
               
              
                            </div>
        </div>
    
 

  @endif
       

  
 