<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf</title>
    <style>
        body
        {
            font-size:16px !important;
            width: 8.3in;
            height: 11.7in;
        }

        body
        {
           /* // font-family: 'banglaNikos', sans-serif; */
        /* font-size: 14px; */

        }
		table
		{
			width: 100%;
			border-collapse: collapse;
		}

    </style>
</head>
<body>

    @foreach($childNoteNewList as $key=>$childNoteNewLists)
    <?php
     //dd($childNoteNewLists->receiver);
    $creatorNAme = DB::table('admins')
    ->where('id',$childNoteNewLists->admin_id)
    ->value('admin_name_ban');

                ?>

<div  style="margin-top:35px;">

    @if($childNoteNewLists->admin_id == Auth::guard('admin')->user()->id)

    @include('admin.presentDocument.printViewSecondpart')

    @else

    @if(($childNoteNewLists->sent_status == 1) && ($childNoteNewLists->receiver_id == Auth::guard('admin')->user()->id))


    <?php
    $paraSentStatus = DB::table('nothi_details')
                                ->where('noteId',$id)
                                ->where('nothId',$nothiId)
                                ->where('dakId',$parentId)
                                ->where('dakType',$status)
                                ->where('childId',$childNoteNewLists->id)
                                ->where('receiver',Auth::guard('admin')->user()->id)
                                ->update(array('view_status' => 1));


    ?>
    @include('admin.presentDocument.printViewSecondpart')

    @else

    <?php
    $paraSentStatusNewOneTwo = DB::table('seal_statuses')
                                ->where('nothiId',$nothiId)
                                ->where('status',$status)
                                ->where('receiver',Auth::guard('admin')->user()->id)
                                //->orderBy('id','asc')
                                //->where('seal_status',1)
                                ->value('nothiId');

                                $paraSentStatusNewOneTwoThree = DB::table('seal_statuses')
                                ->where('nothiId',$nothiId)
                                ->where('status',$status)
                              //  ->where('receiver',Auth::guard('admin')->user()->id)
                               // ->orderBy('id','asc')
                                //->where('seal_status',1)

                                ->where('childId',$childNoteNewLists->id)
                                ->value('nothiId');

    ?>

    <!-- new code  start-->



    @if($paraSentStatusNewOneTwo  == $paraSentStatusNewOneTwoThree)

    @include('admin.presentDocument.printViewSecondpart')
    @endif


    <!--  end new code -->




    @endif


     @endif

    </div>
          @endforeach




</body>
</html>
