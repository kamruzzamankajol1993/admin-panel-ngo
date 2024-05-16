

<div class="mb-0 m-t-30">
    <table class="table table-bordered">
        <tr>

            <th>নথি দেখুন</th>
        </tr>


        @if($getNgoType == 'Foreign')



        @foreach($allNameChangeDoc as $key=>$AllNameChangeInfoDoc)



        @if(($key+1) ==1)

        <tr>
            <td>


        <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
            ০২টি জাতীয় পত্রিকায় (বাংলা ও ইংরেজী পত্রিকায়) নাম পরিবর্তন বিষয়ে বিজ্ঞাপনের মূলকপি
       </a>
    </td>

</tr>

        @elseif(($key+1) ==2)

        <tr>
            <td>
        <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
            নাম পরিবর্তন ফি বাবদ-২৬,০০০/- (ছাব্বিশ হাজার) টাকার (কোড নং-১-০৩২৩-০০০০- ১৮৩৬) চালানের মূলকপি এবং ১৫% ভ্যাট (কোড নং - ১-১১৩৩ -০০৩৫ - ০৩১১) প্রদানপূর্বক চালানের মূলকপিসহ
       </a>

    </td>

</tr>

@elseif(($key+1) ==3)

        <tr>
            <td>
        <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
            গঠনতন্ত্র পরিবর্তন ফি বাবদ- ১৩,০০০/- (তের হাজার) টাকার (কোড নং-১-০৩২৩-০০০০- ১৮৩৬) চালানের মূলকপি এবং ১৫% (কোড নং -১-১১৩৩-০০৩৫-০৩১১) জমাপূর্বক চালানের মূলকপিসহ
       </a>

    </td>

</tr>

       @elseif(($key+1) ==4)

       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        সংশ্লিষ্ট দেশের বোর্ড অব ডিরেক্টরস /বোর্ড অব ট্রাস্টির তালিকা ( সংশ্লিষ্ট দেশের পিস অব জাস্টিস কর্তৃক নোটারীকৃত )
   </a>

</td>

</tr>
       @elseif(($key+1) ==5)


       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
       নাম পরিবর্তন বিষয়ে সংশ্লিষ্ট দেশের বোর্ড অব ডিরেক্টরস /বোর্ড অব ট্রাস্টির সিদ্ধান্তের কপি  (সংশ্লিষ্ট দেশের পিস অব জাস্টিস কর্তৃক নোটারীকৃত মূলকপিসহ )
       </a>

    </td>

</tr>
       @elseif(($key+1) ==6)

       <tr>
        <td>


       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        ৩০০/(তিনশত) টাকার স্টাম্পে নাম পরিবর্তনের বিষয়ে এফিডেবিট এর কপি
        </a>


    </td>

</tr>

       @elseif(($key+1) ==7)

       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        এনজিও বিষয়ক ব্যুরোর মুল সনদপত্র
        </a>
    </td>

</tr>
       @elseif(($key+1) ==8)

       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        সংস্থার পরিবর্তিত নামের সনদপত্র /ইনকর্পোরেটর সার্টিফিকেট (সংশ্লিষ্ট দেশের নোটারীকৃত মূলকপি )
        </a>
    </td>

</tr>
       @elseif(($key+1) ==9)

       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        সংস্থার পরিবর্তিত নামের বাই লজ (By Laws)/গঠনতন্ত্রের কপি (সংশ্লিষ্ট দেশের পিস অব জাস্টিস কতৃক নোটারীকৃত মূলকপিসহ )
        </a>

    </td>

</tr>

       @elseif(($key+1) ==10)

       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        সংস্থার পূর্ববর্তী নামের সকল দায় -দায়িত্ব বর্তমানে পরিবর্তিত নামের সংস্থার উপর বর্তাইবে মর্মে অঙ্গীকার নামা (সংস্থার প্রধান কতৃক স্বাক্ষরিত )
        </a>

    </td>

</tr>

       @elseif(($key+1) ==11)


       <tr>
        <td>
       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        ২০১০-২০১১ অর্থবছর হতে হালনাগাদ পর্যন্ত সংস্থার নিবন্ধন/নিবন্ধন নবায়ন /নাম পরিবর্তন /গঠনতন্ত্রের যে কোনো ধারা পরিবর্তনের বিষয়ের দাখিলকৃত ফি এর ১৫% বকেয়া ভ্যাট (যদি ইতিমধ্যে প্রদান করা হয়ে না থাকে ) সংশ্লিষ্ট কোডে
        জমাপূর্বক চালানের মুলকপিসহ
        </a>

    </td>




       @elseif(($key+1) ==12)

       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        প্রাথমিক নিবন্ধনকারী কতৃপক্ষের অনুমোদিতো গঠনতন্ত্রের সত্যায়িত কপি
        </a>

    </td>

</tr>

       @elseif(($key+1) ==13)

       <tr>
        <td>


       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        সংস্থার চেয়ারম্যান ও সেক্রেটারি কর্তৃক যৌথ স্বাক্ষরিত গঠনতন্ত্র পরিচ্ছন্ন কপি
        </a>
    </td>

</tr>


       @elseif(($key+1) ==14)

       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ফি জমা প্রদানের চালানের মূলকপি
        </a>

    </td>

</tr>

       @elseif(($key+1) ==15)

       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ও সংযোজনের বিষয়ে সাধারণ সভার কার্যবিবরণীর সত্যায়িত কপি
        </a>

    </td>

</tr>
       @elseif(($key+1) ==16)

       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        পূর্ব গঠনতন্ত্র ও বর্তমান গঠনতন্ত্রের তুলনামূলক বিবরণী (প্রতি পাতায় সভাপতি ও সম্পাদকের যৌথ স্বাক্ষরসহ)
        </a>

    </td>

</tr>
       @endif




        @endforeach





        @else
        @foreach($allNameChangeDoc as $key=>$AllNameChangeInfoDoc)



        @if(($key+1) ==1)

<tr>
       <td>

        <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
            ০২টি জাতীয় পত্রিকায় ( বাংলা ও ইংরেজী পত্রিকায় "নাম পরিবর্তন বিষয়ে বিজ্ঞাপনের মূলকপি
       </a>
    </td>
</tr>


        @elseif(($key+1) ==2)


        <tr>
            <td>


        <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
            নাম পরিবর্তন ফি বাবদ-২৬,০০০/- (ছাব্বিশ হাজার) টাকার (কোড নং-১-০৩২৩-০০০০- ১৮৩৬) চালানের মূলকপি এবং ১৫% ভ্যাট (কোড নং - ১-১১৩৩ -০০৩৫ - ০৩১১) প্রদানপূর্বক চালানের মূলকপিসহ
       </a>

    </td>

</tr>

@elseif(($key+1) ==3)


<tr>
    <td>


<a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
    গঠনতন্ত্র পরিবর্তন ফি বাবদ- ১৩,০০০/- (তের হাজার) টাকার (কোড নং-১-০৩২৩-০০০০- ১৮৩৬) চালানের মূলকপিসহ
</a>

</td>

</tr>
       @elseif(($key+1) ==4)


<tr>
       <td>
       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        ফরম -৮ মোতাবেক নির্বাহী কমিটির তালিকা
   </a>


</td>

</tr>


       @elseif(($key+1) ==5)

       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        নির্বাহী কমিটির সদস্যদের ভোটার আইডি কার্ডের ফটোকপিসহ সত্যায়িত পাসপোর্ট সাইজের ছবি
       </a>

    </td>

</tr>


       @elseif(($key+1) ==6)

       <tr>
        <td>


       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        ৩০০/তিনশত) টাকার স্টাম্পে নাম পরিবর্তনের বিষয়ে এফিডেবিট এর কপি
        </a>


    </td>

</tr>

       @elseif(($key+1) ==7)

       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        এনজিও বিষয়ক ব্যুরোর মুল সনদপত্র
        </a>

    </td>

</tr>

       @elseif(($key+1) ==8)


       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        পরিবর্তিত নামে প্রাথমিক নিবন্ধন প্রদানকারী কর্তৃপক্ষের সত্যায়িত সনদপত্রের কপি
        </a>

    </td>

</tr>

       @elseif(($key+1) ==9)


       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        প্রাথমিক নিবন্ধন প্রদানকারী কর্তৃপক্ষের অনুমোদিত নির্বাহী কমিটির তালিকার সত্যায়িত কপি
        </a>

    </td>

</tr>

       @elseif(($key+1) ==10)


       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        সর্বশেষ সাধারণ সদস্যদের তালিকা
        </a>
        </td>
       </tr>

        @elseif(($key+1) == 11)

        <tr>
            <td>

        <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
            নাম পরিবর্তন সংক্রান্ত বিষয়ে সাধারণ সভার কা্যবিবরণীর (উপস্থিত সদস্যদের তালিকাসহ) সত্যায়িত কপি
            </a>

        </td>

    </tr>
            @elseif(($key+1) == 12)

            <tr>
                <td>

            <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
                পূর্ববর্তী নামের সকল দায়-দায়িত্ব বর্তমানে পরিবর্তিত নামের সংস্থার উপর বর্তাইবে মর্মে অংগীকার নামা (সভাপতি ও সাধারণ সম্পাদক কর্তৃক স্বাক্ষরিত)।
                </a>
                </td>
            </tr>

                @elseif(($key+1) == 13)

                <tr>
                    <td>

                <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
                    দাখিলকৃত চালানের ডপর ১৫% ভ্যাট নির্ধারিত কোডে জমাপূর্বক চালানের মূলকলিসহ (কোড নং-১-১১৩৩-০০৩৫-০৩১১)
                    </a>

                </td>

            </tr>

       @elseif(($key+1) ==14)


       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        ২০১০-২০১১ অর্থবছর হতে হালনাগাদ পর্যন্ত সংস্থার নিবন্ধন/নিবন্ধন নবায়ন /নাম পরিবর্তন /গঠনতন্ত্রের যে কোনো ধারা পরিবর্তনের বিষয়ের দাখিলকৃত ফি এর ১৫% বকেয়া ভ্যাট (যদি ইতিমধ্যে প্রদান করা হয়ে না থাকে ) সংশ্লিষ্ট কোডে
        জমাপূর্বক চালানের মুলকপিসহ
        </a>
    </td>

</tr>
       
       @elseif(($key+1) ==15)

       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        প্রাথমিক নিবন্ধনকারী কতৃপক্ষের অনুমোদিতো গঠনতন্ত্রের সত্যায়িত কপি
        </a>

        </td>
       </tr>
       @elseif(($key+1) ==16)


       <tr>
        <td>


       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        সংস্থার চেয়ারম্যান ও সেক্রেটারি কর্তৃক যৌথ স্বাক্ষরিত গঠনতন্ত্র পরিচ্ছন্ন কপি
        </a>

    </td>

</tr>
       @elseif(($key+1) ==17)


       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ফি জমা প্রদানের চালানের মূলকপি
        </a>
    </td>

</tr>
       @elseif(($key+1) ==18)


       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        গঠনতন্ত্রের কোন ধারা, উপধারা পরিবর্তন ও সংযোজনের বিষয়ে সাধারণ সভার কার্যবিবরণীর সত্যায়িত কপি
        </a>
        </td>
       </tr>
       @elseif(($key+1) ==19)


       <tr>
        <td>

       <a target="_blank"  href="{{ route('nameChangeDoc',$AllNameChangeInfoDoc->id) }}" >
        পূর্ব গঠনতন্ত্র ও বর্তমান গঠনতন্ত্রের তুলনামূলক বিবরণী (প্রতি পাতায় সভাপতি ও সম্পাদকের যৌথ স্বাক্ষরসহ)
        </a>


    </td>

       </tr>
       @endif




        @endforeach
    @endif
    </table>
</div>
