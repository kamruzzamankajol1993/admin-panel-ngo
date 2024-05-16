
<?php
$get_user_id = DB::table('fd_one_forms')->where('id',$ngoId)->value('organization_name');
$get_user_id1 = DB::table('fd_one_forms')->where('id',$ngoId)->value('registration_number');
?>
{{-- <p>CongraYour Request Has Been {{ $id }}</p>

<h2>------------------</h2>
<p><b>NGO Affairs Bureau</b> <br>
    Prime Minister's Office <br>
    Plot-E-13/B, Agargaon. Sher-e-Bangla Nagar, Dhaka-1207
</p> --}}


@if($id == 'Ongoing')
Dear <b>{{$get_user_id}}</b>,

your NGO registration has been {{ $id }}. We'll assess the situation, and consider the next steps. Your dedication remains valuable, and we'll overcome this setback together.



<p><b>NGO Affairs Bureau</b> <br>
    Prime Minister's Office <br>
    Plot-E-13/B, Agargaon. Sher-e-Bangla Nagar, Dhaka-1207
</p>

@elseif($id == 'Accepted')
<p>Dear <b>{{$get_user_id}}</b>,</p>
<p>We are excited to announce that you NGO, <b>[{{$get_user_id}}]</b>, has been officially registered! 🎉 <b style="font-size: 18px;">Congratulations</b>
    to each one of you for
    making this significant achievement possible.</p>
<p>Your NGO Registration NO: <b>{{ $get_user_id1 }}</b></p>
<p>Thank you for your tireless efforts and unwavering belief in our mission. As we move forward, let's carry this same
    enthusiasm and determination to create positive change in our community.</p>
<p>Congratulations once again!</p>
<p>Best regards, <br>
    <b>NGO Affairs Bureau</b> <br>
    Prime Minister's Office <br>
    Plot-E-13/B, Agargaon. Sher-e-Bangla Nagar, Dhaka-1207</p>
@elseif($id == 'Rejected' || $id == 'Correct')
{{-- <p>Your Request Has Been {{ $id }}</p>

<h2>------------------</h2> --}}

Dear <b>{{$get_user_id}}</b>,


Unfortunately,

<b>
@if($id = 'Correct')
your NGO registration need some Correction
@else
your NGO registration has been {{ $id }}

@endif
</b>

.<br>Becaouse Of <b>"{{ $comment }}"</b> , <br>We'll assess the situation, and consider the next steps. Your dedication remains valuable, and we'll overcome this setback together.



<p><b>NGO Affairs Bureau</b> <br>
    Prime Minister's Office <br>
    Plot-E-13/B, Agargaon. Sher-e-Bangla Nagar, Dhaka-1207
</p>
@endif



