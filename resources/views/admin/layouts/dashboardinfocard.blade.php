<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="row">
  <div class="col-sm-12">
    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
      <h2 class="card-title">{{$titleToday}}</h2>
      <div class="row">
        <div class="card">
          <div class="card-body">
            <div class="col-sm-12">
              <div class="statistics-details d-flex align-items-center justify-content-between">
                <div>
                  <p class="statistics-title">Admissions</p>
                  <h3 class="rate-percentage admission-today">{{$todayAdmissions}}
                </div>
                <div>
                  <p class="statistics-title">Enrollments</p>
                  <h3 class="rate-percentage enrollments-today">{{$todayEnrollments}}
                </div>
                <div>
                  <p class="statistics-title">Awaiting Enrollments</p>
                  <h3 class="rate-percentage pending-enrollments-today">{{$totalPendingEnrollments}}
                </div>
                <div>
                  <p class="statistics-title">Training Sessions</p>
                  <h3 class="rate-percentage traninings-today">{{$todayTraineeSessions}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
      <h2 class="card-title">{{$titleThisWeek}}</h2>
      <div class="row">
        <div class="card">
          <div class="card-body">
            <div class="col-sm-12">
              <div class="statistics-details d-flex align-items-center justify-content-between">
                <div>
                  <p class="statistics-title">Admissions</p>
                  <h3 class="rate-percentage">{{$admissionsThisWeek}}
                </div>
                <div>
                  <p class="statistics-title">Enrollments</p>
                  <h3 class="rate-percentage">{{$enrollmentsThisWeek}}
                </div>
                <div>
                  <p class="statistics-title">Training Sessions</p>
                  <h3 class="rate-percentage">{{$trainingSessionsThisWeek}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
      <h2 class="card-title">{{$titleAllTime}}</h2>
      <div class="row">
        <div class="card">
          <div class="card-body">
            {{--//TODO: Modify the insight cards for optimization and efficiency--}}
            <div class="col-sm-12">
              <div class="statistics-details d-flex align-items-center justify-content-between">
                <div>
                  <p class="statistics-title">Admissions</p>
                  <h3 class="rate-percentage">{{$totalAdmissions}}
                </div>
                <div>
                  <p class="statistics-title">Enrollments</p>
                  <h3 class="rate-percentage">{{$totalEnrollments}}
                </div>
                <div>
                  <p class="statistics-title">Training Sessions</p>
                  <h3 class="rate-percentage">{{$totalTraineeSessions}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
  <h2 class="card-title">Charts - Today vs This week</h2>
  <div class="row">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <!-- today chart -->
          <div class="col-sm-6">
            <canvas id="myChart" width="250" height="250"></canvas>
            <script>
              var countTodayAdmission = '<?php echo $todayAdmissions; ?>';
              var countTodayEnrollment = '<?php echo $todayEnrollments; ?>';
              var countTodayTraining = '<?php echo $todayTraineeSessions; ?>';
              const ctx = document.getElementById('myChart').getContext('2d');
              const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: ['Admission', 'Enrollments', 'Training Sessions'],
                  datasets: [{
                    label: "Today's Stats",
                    data: [countTodayAdmission, countTodayEnrollment, countTodayTraining],
                    backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                  }]
                },
                options: {
                  scales: {
                    y: {
                      beginAtZero: true
                    }
                  }
                }
              });
              </script>

          </div>
          <!-- this week chart -->
          <div class="col-sm-6">
            <canvas id="myChart1" width="250" height="250"></canvas>
            <script>
              var countThisWeekAdmission = '<?php echo $admissionsThisWeek; ?>';
              var countThisWeekEnrollment = '<?php echo $enrollmentsThisWeek; ?>';
              var countThisWeekTraining = '<?php echo $trainingSessionsThisWeek; ?>';
              const ctx1 = document.getElementById('myChart1').getContext('2d');
              const myChart1 = new Chart(ctx1, {
                type: 'bar',
                data: {
                  labels: ['Admission', 'Enrollments', 'Training Sessions'],
                  datasets: [{
                    label: "This Week's Stats",
                    data: [countThisWeekAdmission, countThisWeekEnrollment, countThisWeekTraining],
                    backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                  }]
                },
                options: {
                  scales: {
                    y: {
                      beginAtZero: true
                    }
                  }
                }
              });
              // console.log(document.querySelector('.admission-today').val);
              // console.log(document.querySelector('.admission-today').innerHTML = a[0].getAttribute("value");
            </script>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>