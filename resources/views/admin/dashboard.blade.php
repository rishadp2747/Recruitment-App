@extends('layouts.admin')

@section('content')
@php

if($cert_count2==1){
$path_2 = '/var/www/html/storage/uploads/admin/students/selected'.str_replace(' ', '', strtolower($uname)).'.csv';
$path_url_2 = url('storage/uploads/admin/students/selected'.str_replace(' ', '', strtolower($uname)).'.csv');

if(file_exists($path_2)){
   File::delete($path_2);
}

if(isset($applied2) && isset($stud_det2)){
$max_qual_2 = $data_num2;
$numb_2 = 0;
$numb2_2 = 0;
$name_arr_2 = array('Index','Application Id','Job Id','Job Name','Applied On','Application Status','Student Name','Company Name','Company Email','Student Email','Job Title','Status','Age','DOB','Phone No.','Skills','Volunteership','Linkedin URL','Github URL','Bio','Gender','Asap_Skills','Aadhaar');
for($x=1;$x<=$max_qual_2;$x++){
  $n1_2 = 'Qualification '.(string)$x;
  $n2_2 = 'Course '.(string)$x;
  $n3_2 = 'Specialisation '.(string)$x;
  $n4_2 = 'Percentage '.(string)$x;
  $n5_2 = 'Board '.(string)$x;
  $n6_2 = 'Institution '.(string)$x;
  $n7_2 = 'Joining Date '.(string)$x;
  $n8_2 = 'Passing Date '.(string)$x;
  $n9_2 = 'Current Backlogs '.(string)$x;
  $n10_2 = 'History of Backlogs '.(string)$x;
  array_push($name_arr_2,$n1_2,$n2_2,$n3_2,$n4_2,$n5_2,$n6_2,$n7_2,$n8_2,$n9_2,$n10_2);
}
  foreach($applied2 as $ap){
    $numb_2 = $numb_2 +1;
    ${"new_2_" . $numb_2} = array($numb_2,$ap->U_Id,$ap->Job_Id,$ap->Job_Title,$ap->created_at,$ap->Status,$name2[$numb_2-1]->name,$comp_name2[$numb_2-1]->name,$ap->Company_Email,$ap->Student_Email,$ap->Job_Title,$ap->Status);
  }
  $hg_2 = 0;
  foreach($stud_det2 as $st){
    $numb2_2 = $numb2_2 +1;
    ${"new_2_2_" . $numb2_2} = array($st->Age,$st->DOB,$st->Phoneno,$st->Skills,$st->Volunteership,$st->Linkedin,$st->Github,$st->Bio,$st->Gender, $st->Asap_Skills,$st->Aadhaar);
    ${"new_3_2_" . $numb2_2} = array();
      foreach($stud_qual2[$hg_2] as $fin){
        if($fin->qualification==1){
            $qua_2 = '10th';
        }
        elseif($fin->qualification==2){
            $qua_2 = '12th';
        }
        elseif($fin->qualification==3){
            $qua_2 = 'Post Graduation';
        }
        elseif($fin->qualification==4){
            $qua_2 = 'Diploma';
        }
        array_push(${"new_3_2_" . $numb2_2},$qua_2,$fin->course,$fin->specialisation,$fin->cgpa,$fin->board,$fin->institution,$fin->join,$fin->pass,$fin->cbacklogs,$fin->hbacklogs);  
      }
      $hg_2 = $hg_2 + 1;
    ${"final_2_" . $numb2_2} = (array_merge(${"new_2_" . $numb2_2},${"new_2_2_" . $numb2_2},${"new_3_2_" . $numb2_2}));
  }
$fp_2 = fopen($path_2, 'w');
fputcsv($fp_2, $name_arr_2);
for($f=1;$f<=$numb_2;$f++){
  fputcsv($fp_2, ${"final_2_" . $f});
}
fclose($fp_2);
}
}
if($cert_count3==1){
$path_3 = '/var/www/html/storage/uploads/admin/students/notselected'.str_replace(' ', '', strtolower($uname)).'.csv';
$path_url_3 = url('storage/uploads/admin/students/notselected'.str_replace(' ', '', strtolower($uname)).'.csv');

if(file_exists($path_3)){
   File::delete($path_3);
}

if(isset($applied3) && isset($stud_det3)){
$max_qual_3 = $data_num3;
$numb_3 = 0;
$numb2_3 = 0;
$name_arr_3 = array('Index','Application Id','Job Id','Job Name','Applied On','Application Status','Student Name','Company Name','Company Email','Student Email','Job Title','Status','Age','DOB','Phone No.','Skills','Volunteership','Linkedin URL','Github URL','Bio','Gender','Asap_Skills','Aadhaar');
for($x=1;$x<=$max_qual_3;$x++){
  $n1_3 = 'Qualification '.(string)$x;
  $n2_3 = 'Course '.(string)$x;
  $n3_3 = 'Specialisation '.(string)$x;
  $n4_3 = 'Percentage '.(string)$x;
  $n5_3 = 'Board '.(string)$x;
  $n6_3 = 'Institution '.(string)$x;
  $n7_3 = 'Joining Date '.(string)$x;
  $n8_3 = 'Passing Date '.(string)$x;
  $n9_3 = 'Current Backlogs '.(string)$x;
  $n10_3 = 'History of Backlogs '.(string)$x;
  array_push($name_arr_3,$n1_3,$n2_3,$n3_3,$n4_3,$n5_3,$n6_3,$n7_3,$n8_3,$n9_3,$n10_3);
}
  foreach($applied3 as $ap){
    $numb_3 = $numb_3 +1;
    ${"new_3_" . $numb_3} = array($numb_3,$ap->U_Id,$ap->Job_Id,$ap->Job_Title,$ap->created_at,$ap->Status,$name3[$numb_3-1]->name,$comp_name3[$numb_3-1]->name,$ap->Company_Email,$ap->Student_Email,$ap->Job_Title,$ap->Status);
  }
  $hg_3 = 0;
  foreach($stud_det3 as $st){
    $numb2_3 = $numb2_3 +1;
    ${"new_2_3_" . $numb2_3} = array($st->Age,$st->DOB,$st->Phoneno,$st->Skills,$st->Volunteership,$st->Linkedin,$st->Github,$st->Bio,$st->Gender, $st->Asap_Skills,$st->Aadhaar);
    ${"new_3_3_" . $numb2_3} = array();
      foreach($stud_qual3[$hg_3] as $fin){
        if($fin->qualification==1){
            $qua_3 = '10th';
        }
        elseif($fin->qualification==2){
            $qua_3 = '12th';
        }
        elseif($fin->qualification==3){
            $qua_3 = 'Post Graduation';
        }
        elseif($fin->qualification==4){
            $qua_3 = 'Diploma';
        }
        array_push(${"new_3_3_" . $numb2_3},$qua_3,$fin->course,$fin->specialisation,$fin->cgpa,$fin->board,$fin->institution,$fin->join,$fin->pass,$fin->cbacklogs,$fin->hbacklogs);  
      }
      $hg_3 = $hg_3 + 1;
    ${"final_3_" . $numb2_3} = (array_merge(${"new_3_" . $numb2_3},${"new_2_3_" . $numb2_3},${"new_3_3_" . $numb2_3}));
  }
$fp_3 = fopen($path_3, 'w');
fputcsv($fp_3, $name_arr_3);
for($f=1;$f<=$numb_3;$f++){
  fputcsv($fp_3, ${"final_3_" . $f});
}
fclose($fp_3);
}
}

@endphp
<!-- Page Heading -->
<p class="p mb-4 text-gray-800">{{ $uname }} you are successfully logged in.</p>

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Students Registered</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $s_count }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-graduate fa-2x" style="color: #4e73df !important;"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Companys Registered</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $c_count }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-building fa-2x green"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tasks Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Jobs Posted</div>
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $j_count }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tools fa-2x red"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Applications Recieved</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $a_count }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-file-alt fa-2x" style="color: #F1C40F !important;"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
          	@if(!$c_1==0 || !$c_2==0 || !$c_3==0 || !$c_4==0 || !$c_5==0 || !$c_6==0 || !$c_7==0)
          	<!-- Donut Chart -->
            <div class="col-xl-4 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Applications Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4">
                    <canvas id="myPieChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
            @endif
            @if($cert_count2==1 || $cert_count3==1)
            <div class="col-xl-8 col-lg-6">
            	<div class="row justify-content-center">
            		<p class="jobhead"><b>Excel File Download</b> <i class="fas fa-file-excel"></i></p>
            	</div>
                @if($cert_count2==1)
            	<a href="{{ $path_url_2 }}" class="btn btn-success btn-block btn-lg">
                    <span class="text">Selected Applicants</span>
                  </a>
                  @endif
                 @if($cert_count3==1)
                  <a href="{{ $path_url_3 }}" class="btn btn-danger btn-block btn-lg">
                    <span class="text">Not Selected Applicants</span>
                  </a>
                  @endif
            </div>
            @endif
          </div>
          <!-- Page level plugins -->
          <script src="./vendor/chart.js/Chart.min.js"></script>
          <script type="text/javascript">
          	// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Applied Applications", "Reviewing Appications", "Waitlisted Applications","Approved Applications","Rejected Applications","Selected Applications","Not Selected Applications"],
    datasets: [{
      data: [{{$c_1}}, {{$c_2}}, {{$c_3}}, {{$c_4}}, {{$c_5}}, {{$c_6}}, {{$c_7}}],
      backgroundColor: ['#273746', '#707B7C', '#F1C40F','#28B463','#E74C3C','#16A085','#C0392B'],
      hoverBackgroundColor: ['#000000', '#424949', '#B7950B','#1D8348','#B03A2E','#0E6655','#7B241C'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
          </script>
@endsection