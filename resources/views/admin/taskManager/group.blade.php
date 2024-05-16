<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<label  for="admin_id">কর্মকর্তার নাম </label>

            <select multiple="multiple"  class="form-control form-control-sm js-example-basic-multiple" required name="admin_id[]" id="admin_id">
                <option value="">--অনুগ্রহ করে নির্বাচন করুন--</option>
                @foreach($users as $AllBranchLists)
                <option value="{{ $AllBranchLists->id }}" >{{ $AllBranchLists->admin_name_ban }}</option>
                @endforeach
            </select>
            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
                $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            $('.js-example-basic-single').select2();
        });
             </script>
