<option value="">--অনুগ্রহ করে নির্বাচন করুন--</option>
@foreach($designationLists as $AllDesignationLists)
<option value="{{ $AllDesignationLists->id }}">{{ $AllDesignationLists->designation_name }}</option>
@endforeach
