@extends('admin.forms.layout')


@php
$current_date = date('Y-m-d');
$minDate = date('Y-m-d', strtotime('-16 year'));
@endphp

@section('form')
<p class="card-description">
                      Personal info
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="fname" class="col-sm-3 col-form-label">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="eg. Ram">
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="mname" class="col-sm-3 col-form-label">Middle Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="mname" name="mname" placeholder="eg. Bahadur">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="lname" class="col-sm-3 col-form-label">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="eg. Khatri">
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control" id="dob" name="dob" max="<?= $minDate; ?>">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="fname" name="email" placeholder="eg. khatriram55@gmail.com">
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                          <div class="col-sm-9">
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="eg. 9800000000">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="bloodgroup" class="col-sm-3 col-form-label">Blood Group</label>
                          <div class="col-sm-9">
                            <select name="bloodgroup" id="bloodgroup" name="bloodgroup" class="form-control">
                              <option selected default>Select your blood group</option>
                              <option value="a-pos">A+</option>
                              <option value="a-neg">A-</option>
                              <option value="b-pos">B+</option>
                              <option value="b-neg">B-</option>
                              <option value="o-pos">O+</option>
                              <option value="o-neg">O-</option>
                              <option value="ab-pos">AB+</option>
                              <option value="ab-neg">AB-</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6 ml-auto mr-auto">
                        <input type="submit" value="Admit" name="admit" class="form-control btn btn-success">
                      </div>
                    </div>
{{--
<div class="form-group row">
          <div class="col-sm-4">
            <label for="fname" class="col-sm-10 col-form-label">First Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="fname" name="fname" placeholder="eg. Ram">
            </div>
          </div>
          <div class="col-sm-4">
            <label for="mname" class="col-sm-10 col-form-label">Middle Name (if applicable)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="mname" name="mname" placeholder="e.g. Bahadur">
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-4">
            <label for="lastname" class="col-sm-10 col-form-label">Last Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="lname" name = "lname" placeholder="eg. Khatri">
            </div>
          </div>
          <div class="col-sm-4">
            <label for="dob" class="col-sm-10 col-form-label">Date of Birth (AD)</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="dob" name="dob" max="<?= $minDate; ?>">
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-4">
            <label for="email" class="col-sm-10 col-form-label">Email Address</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" placeholder="eg. khatriram55@gmail.com">
            </div>
          </div>
          <div class="col-sm-4">
            <label for="phone" class="col-sm-10 col-form-label" value="+977">Phone</label>
            <div class="col-sm-10">
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="eg. 9800000000" maxlength="10">
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-4">
            <label for="email" class="col-sm-10 col-form-label">Blood Group</label>
            <div class="col-sm-10">
              <select name="bloodgroup" id="bloodgroup" name="bloodgroup" class="form-control">
                <option selected default>Select your blood group</option>
                <option value="a-pos">A+</option>
                <option value="a-neg">A-</option>
                <option value="b-pos">B+</option>
                <option value="b-neg">B-</option>
                <option value="o-pos">O+</option>
                <option value="o-neg">O-</option>
                <option value="ab-pos">AB+</option>
                <option value="ab-neg">AB-</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6 ml-auto mr-auto">
            <input type="submit" value="Admit" name="admit" class="form-control btn btn-success">
          </div>
        </div>
        --}}

@endSection