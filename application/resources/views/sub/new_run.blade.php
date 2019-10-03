<?php
use App\Models\News;
use App\Models\Category;
$languageId = getLanguageId();
if($languageId==2){
?>
<div class=page-widget>
            <div class=page-widget-new>
               <div class=newsticker_title>
                  <div class=newsticker_titlea>Tin mới</div>
               </div>
               <div class=newsticker_content>
                  <ul id=js-news class=js-hidden>
				  <?php
				 
				  $cates=Category::where('parent_id',13)->get();
				  $cateListId=[];
				  foreach($cates as $item1){
					  $cateListId[]=$item1->id;
				  }
				  shuffle($cateListId);
				  $news = News::whereIn('cate_id',$cateListId)->where('is_delete',0)->where('is_active',1)->where('is_approval',1)->take(5)->orderBy('id','desc')->get();
				  ?>
				  @foreach($news as $item)
              <?php
               $cateIdNew=$item->cate_id;
               $link='';
               switch ($cateIdNew) {
                  case 14:
                     $link='tin-tuc/tin-tuc-chi-tiet/';
                     break;
                  case 15:
                     $link='tin-tuc/diem-bao-thi-truong-chi-tiet/';
                     break;
                  case 16:
                     $link='tin-tuc/hop-tac-dau-tu-chi-tiet/';
                     break;
                  case 17:
                     $link='tin-tuc/dau-thau-chi-tiet/';
                     break;
                  case 18:
                     $link='tin-tuc/hoat-dong-spt-chi-tiet/';
                     break;
                  default:
                     break;
               }
              ?>
                     <li class=news-item>
                        <a href="{{url($link.$item->id.'/'.vn_to_str($item->title))}}">
                           <div class=tnews-date>{{date('d-m-Y',strtotime($item->created_date))}}</div>
						   {{$item->title}}
                        </a>
                     </li>
                   @endforeach
                  </ul>
               </div>
            </div>
         </div>
         <?php }else{?>
            <div class=page-widget>
            <div class=page-widget-new>
               <div class=newsticker_title>
                  <div class=newsticker_titlea>Latest News</div>
               </div>
               <div class=newsticker_content>
                  <ul id=js-news class=js-hidden>
              <?php
             
              $cates=Category::where('parent_id',13)->get();
              $cateListId=[];
              foreach($cates as $item1){
                 $cateListId[]=$item1->id;
              }
              shuffle($cateListId);
              $news = News::whereIn('cate_id',$cateListId)->whereNotNull('title_en')->where('is_delete',0)->where('is_active_en',1)->where('is_approval_en',1)->take(5)->orderBy('id','desc')->get();
              ?>
              @foreach($news as $item)
              <?php
               $cateIdNew=$item->cate_id;
               $link='';
               switch ($cateIdNew) {
                  case 14:
                     $link='news-events/news-detail/';
                     break;
                  case 15:
                     $link='news-events/the-media-detail/';
                     break;
                  case 16:
                     $link='news-events/investment-cooperation-detail/';
                     break;
                  case 17:
                     $link='news-events/bidding-detail/';
                     break;
                  case 18:
                     $link='news-events/spt-news-detail/';
                     break;
                  default:
                     break;
               }
              ?>
                     <li class=news-item>
                        <a href="{{url($link.$item->id.'/'.vn_to_str($item->title_en))}}">
                           <div class=tnews-date>{{date('d-m-Y',strtotime($item->created_date))}}</div>
                     {{$item->title_en}}
                        </a>
                     </li>
                   @endforeach
                  </ul>
               </div>
            </div>
         </div>
         <?php } ?>
