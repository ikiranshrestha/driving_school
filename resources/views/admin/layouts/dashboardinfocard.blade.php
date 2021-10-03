
    <div class="row">
            <div class="col-sm-12">
              <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                  <h2 class="card-title">{{$titleToday}}</h2>
                    <div class="row">
                      <div class="card">
                        <div class="card-body">
                            {{--//TODO: Add Insights such as total classes today, total admissions today, total enrollments today, etc--}}
                          <div class="col-sm-12">
                            <div class="statistics-details d-flex align-items-center justify-content-between">
                              <div>
                                <p class="statistics-title">Admissions</p>
                                <h3 class="rate-percentage">{{$todayAdmissions}}
                              </div>
                              <div>
                                <p class="statistics-title">Enrollments</p>
                                <h3 class="rate-percentage">{{$todayEnrollments}}
                              </div>
                              <div>
                                <p class="statistics-title">Awaiting Enrollments</p>
                                <h3 class="rate-percentage">{{$totalPendingEnrollments}}
                              </div>
                              <div>
                                <p class="statistics-title">Training Sessions</p>
                                <h3 class="rate-percentage">{{$todayTraineeSessions}}</h3>
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
                            {{--//TODO: Add Insights such as total classes today, total admissions today, total enrollments today, etc--}}
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
