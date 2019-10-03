<ul>
@foreach($childs as $child)
	<li>
	<?php
	    	$res = \DB::selectOne('select count(*) as total from news where is_delete=0 and cate_id='.$child->id);
	    	$count = $res->total;
	    	//echo $count;
	    ?>
	    <a href="{{url('client/show-new-by-catetory/'.$child->id)}}">{{ $child->title }}</a> @if($count>0) ({{$count}}) @endif
	@if(count($child->childs))
            @include('client.manageChild',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul>