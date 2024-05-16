<?php

$checkTracking =DB::table('secruity_checks')
->where('n_visa_id',$mainNVisaId)->get();;

?>
  @if(count($checkTracking) == 0)

  <h1>এখনো জমা দেওয়া হয়নি</h1>

  @else


  <table class="table table-bordered mt-5">
      <thead>
        <tr>

          <th scope="col">ট্র্যাকিং নম্বর</th>
          <th scope="col">স্ট্যাটাসের নাম</th>

        </tr>
      </thead>
      <tbody>
          @foreach($checkTracking as $key=>$AllCheckTracking)
        <tr>

          <td>{{ $AllCheckTracking->tracking_no }}</td>
          <td>{{ $AllCheckTracking->statusName }}</td>

        </tr>
        @endforeach

      </tbody>
    </table>

  @endif
