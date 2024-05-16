<script>
    $("[id^=nothiSearchfdFive]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(17);
                var main_value = $(this).val();


                var status = 'fdFive'

                //alert(result);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultfdFive"+result).html(data);
                }
                });



    });

    </script>
<script>
    $("[id^=nothiSearchcommittee]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(20);
                var main_value = $(this).val();


                var status = 'committee'

                //alert(result);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultcommittee"+result).html(data);
                }
                });



    });

    </script>


<script>
    $("[id^=nothiSearchconstitution]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(23);
                var main_value = $(this).val();


                var status = 'constitution'

                //alert(result);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultconstitution"+result).html(data);
                }
                });



    });

    </script>

<script>
    $("[id^=nothiSearchduplicate]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(20);
                var main_value = $(this).val();


                var status = 'duplicate'

                //alert(main_id);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultduplicate"+result).html(data);
                }
                });



    });

    </script>

<script>
    $("[id^=nothiSearchFdth]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(15);
                var main_value = $(this).val();


                var status = 'fdThree'

                //alert(result);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultFdth"+result).html(data);
                }
                });



    });

    </script>


<script>
    $("[id^=nothiSearchFctw]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(15);
                var main_value = $(this).val();


                var status = 'fcTwo'

                //alert(result);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultFctw"+result).html(data);
                }
                });



    });

    </script>




<script>
    $("[id^=nothiSearchFcon]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(15);
                var main_value = $(this).val();


                var status = 'fcOne'

                //alert(result);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultFcon"+result).html(data);
                }
                });



    });

    </script>


<script>
    $("[id^=nothiSearchFdse]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(15);
                var main_value = $(this).val();


                var status = 'fdSeven'

                //alert(result);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultFdse"+result).html(data);
                }
                });



    });

    </script>


<script>
    $("[id^=nothiSearchFdsi]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(15);
                var main_value = $(this).val();


                var status = 'fdSix'

                //alert(result);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultFdsi"+result).html(data);
                }
                });



    });

    </script>



<script>
    $("[id^=nothiSearchFdno]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(15);
                var main_value = $(this).val();


                var status = 'fdNineOne'

                //alert(result);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultFdno"+result).html(data);
                }
                });



    });

    </script>


<script>
    $("[id^=nothiSearchFdni]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(15);
                var main_value = $(this).val();


                var status = 'fdNine'

                //alert(result);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultFdni"+result).html(data);
                }
                });



    });

    </script>


<script>
    $("[id^=nothiSearchRene]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(15);
                var main_value = $(this).val();


                var status = 'renew'

                //alert(result);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultRene"+result).html(data);
                }
                });



    });

    </script>



<script>
$("[id^=nothiSearchName]").keyup(function(){


            var main_id = $(this).attr('id');
            var result = main_id.slice(15);
            var main_value = $(this).val();


            var status = 'nameChange'

            //alert(result);



            $.ajax({
            url: "{{ route('searchResultForDak') }}",
            method: 'GET',
            data: {main_value:main_value,result:result,status:status},
            success: function(data) {

                 $("#nothiSearchResultName"+result).html(data);
            }
            });



});

</script>



<script>
    $("[id^=nothiSearchRegi]").keyup(function(){


                var main_id = $(this).attr('id');
                var result = main_id.slice(15);
                var main_value = $(this).val();


                var status = 'registration'

                //alert(result);



                $.ajax({
                url: "{{ route('searchResultForDak') }}",
                method: 'GET',
                data: {main_value:main_value,result:result,status:status},
                success: function(data) {

                     $("#nothiSearchResultRegi"+result).html(data);
                }
                });



    });

    </script>

    <!--- nothi jat script -->

    <script>
        $("[id^=nothijatRegiFinal]").click(function(){


            var dakId = $(this).data('dakid');
            var nothiId = $(this).data('nothiid');
            var status = $(this).data('dakstatus');


            //alert(dakId+nothiId+status);


            $.ajax({
                url: "{{ route('updateNothiJat') }}",
                method: 'GET',
                data: {dakId:dakId,nothiId:nothiId,status:status},
                success: function(data) {

                     //$("#nothiSearchResultRegi"+result).html(data);


                     location.reload(true);
        alertify.set('notifier','position','top-center');
          alertify.success('সফলভাবে কপি হয়েছে');
                }
                });


        });


        $("[id^=nothijatRenwFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});


        $("[id^=nothijatSearchRegi]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(18);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJat') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultRegi"+result).html(data);
}
});



});



$("[id^=nothijatSearchRenw]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(18);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatRenew') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultRenw"+result).html(data);
}
});



});

//////////////////

//name change start

$("[id^=nothiJatSearchNameChange]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(24);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatNameChange') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultNameChange"+result).html(data);
}
});



});

$("[id^=nothijatNameChangeFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});


//name change end


//fdNine start
$("[id^=nothiJatSearchFdNine]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(20);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatFdNine') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultFdNine"+result).html(data);
}
});



});

$("[id^=nothijatFdNineFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});


//fdNine End


//fdNineOne start

$("[id^=nothiJatSearchFdNineOne]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(23);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatFdNineOne') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultFdNineOne"+result).html(data);
}
});



});

$("[id^=nothijatFdNineOneFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});


//fdNineOne end


//fdsix start

$("[id^=nothiJatSearchFdSix]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(19);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatFdSix') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultFdSix"+result).html(data);
}
});



});

$("[id^=nothijatFdSixFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});

//fdsix end

//fdseven start


$("[id^=nothiJatSearchFdSeven]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(21);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatFdSeven') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultFdSeven"+result).html(data);
}
});



});

$("[id^=nothijatFdSevenFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});


//fdseven end


//fcone start


$("[id^=nothiJatSearchFcOne]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(19);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatFcOne') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultFcOne"+result).html(data);
}
});



});

$("[id^=nothijatFcOneFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});


//fcone end


//fctwo start

$("[id^=nothiJatSearchFcTwo]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(19);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatFcTwo') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultFcTwo"+result).html(data);
}
});



});

$("[id^=nothijatFcTwoFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});


//fctwo end


//fdthree start

$("[id^=nothiJatSearchFdThree]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(21);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatFdThree') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultFdThree"+result).html(data);
}
});



});

$("[id^=nothijatFdThreeFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});

//fdthree end


//duplicate start

$("[id^=nothiJatSearchDuplicate]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(23);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatDuplicateCertificate') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultDuplicate"+result).html(data);
}
});



});

$("[id^=nothijatDuplicateFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});

//duplicate end



//constitution start

$("[id^=nothiJatSearchConstitution]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(26);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatConstitution') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultConstitution"+result).html(data);
}
});



});

$("[id^=nothijatConstitutionFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});

//constitution end


//committee start

$("[id^=nothiJatSearchCommittee]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(23);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatCommittee') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultCommittee"+result).html(data);
}
});



});

$("[id^=nothijatCommitteeFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});

//committee end


$("[id^=nothiJatSearchfdFive]").keyup(function(){


var main_id = $(this).attr('id');
var result = main_id.slice(20);
var main_value = $(this).val();

//alert(result);



$.ajax({
url: "{{ route('searchResultNothiJatFdFive') }}",
method: 'GET',
data: {main_value:main_value,result:result},
success: function(data) {

     $("#nothijatSearchResultfdFive"+result).html(data);
}
});



});





$("[id^=nothijatfdFiveFinal]").click(function(){


var dakId = $(this).data('dakid');
var nothiId = $(this).data('nothiid');
var status = $(this).data('dakstatus');


//alert(dakId+nothiId+status);


$.ajax({
    url: "{{ route('updateNothiJat') }}",
    method: 'GET',
    data: {dakId:dakId,nothiId:nothiId,status:status},
    success: function(data) {

         //$("#nothiSearchResultRegi"+result).html(data);


         location.reload(true);
alertify.set('notifier','position','top-center');
alertify.success('সফলভাবে কপি হয়েছে');
    }
    });


});
        </script>

    <!-- end nothi jat script -->



