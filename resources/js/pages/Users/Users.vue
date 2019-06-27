<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Users</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Master - <span class="fw-semi-bold">Users</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>
        <b-form id="formPersonal" @submit.stop.prevent="submitPersonal()">
          <b-row>
                  <b-col md="4 p-4 bg-light">
                    <b-row>
                      <b-col md="12" class="pb-1">
                        <b-img thumbnail fluid src="http://leadership.hscni.net/Images/Uploads/anon_user.png" alt="Image 1"></b-img>
                      </b-col>
                    </b-row>

                    <b-row>
                      <b-col md="10">
                        <b-form-file
                          placeholder="Choose a image..."
                          drop-placeholder="Drop file here..."
                        ></b-form-file>
                      </b-col>
                    </b-row>
                  </b-col>

                  <b-col md="8">
                    <b-row>
                      <b-col md="6">
                        <b-form-group id="input-group-1" label="*Employee No:" label-for="input-1">
                          <b-form-input
                            id="input-1"
                            required
                            value=""
                            placeholder="Enter Employee No"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-2" label="*EPF No:" label-for="input-2">
                          <b-form-input
                            id="input-2"
                            required
                            value=""
                            placeholder="Enter EPF No"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-3" label="*First Name:" label-for="input-3">
                          <b-form-input
                            id="input-3"
                            required
                            value=""
                            placeholder="Enter First Name"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-4" label="*Last Name:" label-for="input-4">
                          <b-form-input
                            id="input-4"
                            required
                            value=""
                            placeholder="Enter Last Name"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-5" label="Gender:" label-for="input-5">
                          <b-form-select class="mb-3" id="input-5">
                            <option value="" selected disabled>Select Gender</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-6" label="*Date of Birth:" label-for="input-6">
                          <b-form-input
                           type="date"
                            id="input-6"
                            required
                            placeholder="Date of Birth"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                    </b-row>
                  </b-col>

                  <b-col md="12">
                    <b-row>
                       <b-col md="4">
                        <b-form-group id="input-group-7" label="*NIC:" label-for="input-7">
                          <b-form-input
                            id="input-7"
                            required
                            placeholder="NIC"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-8" label="Company:" label-for="input-8">
                          <b-form-select class="mb-3" id="input-8">
                            <option value="1" selected disabled>Select Company</option>
                            <option
                              v-for="data in nationalities"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.short_name + "/" + data.full_name}}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-9" label="Location:" label-for="input-9">
                          <b-form-select class="mb-3" id="input-9">
                            <option value="1" selected disabled>Select Location</option>
                            <option
                              v-for="data in locations"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.location }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-10" label="Department:" label-for="input-10">
                          <b-form-select class="mb-3" id="input-10">
                            <option value="1" selected disabled>Select Department</option>
                            <option
                              v-for="data in departments"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.department }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-11" label="Designation:" label-for="input-11">
                          <b-form-select class="mb-3" id="input-11">
                            <option value="1" selected disabled>Select Designation</option>
                            <option
                              v-for="data in designations"
                              :value="data.id"
                              :key="data.id"
                            >{{ data.designations }}</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-12" label="*Mobile No:" label-for="input-12">
                          <b-form-input
                            id="input-12"
                            required
                            placeholder="Enter Mobile No"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-13" label="*Email:" label-for="input-13">
                          <b-form-input
                            id="input-13"
                            required
                            placeholder="Enter Email Address"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-14" label="Immediate:" label-for="input-14">
                          <b-form-select class="mb-3" id="input-14">
                            <option value="1" selected disabled>Select Immediate</option>
                            <option></option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-15" label="Department Head:" label-for="input-15">
                          <b-form-select class="mb-3" id="input-15">
                            <option value="1" selected disabled>Select Department Head</option>
                            <option></option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-16" label="Higher:" label-for="input-16">
                          <b-form-select class="mb-3" id="input-16">
                            <option value="1" selected disabled>Select Higher</option>
                            <option></option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-17" label="Alternate 1:" label-for="input-17">
                          <b-form-select class="mb-3" id="input-17">
                            <option value="1" selected disabled>Select Alternate 1</option>
                            <option></option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-18" label="Alternate 2:" label-for="input-18">
                          <b-form-select class="mb-3" id="input-18">
                            <option value="" selected disabled>Select Alternate 2</option>
                            <option></option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-19" label="Joined At:" label-for="input-19">
                          <b-form-input
                           type="date"
                            id="input-19"
                            required>
                            </b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-20" label="Left At:" label-for="input-20">
                          <b-form-input
                           type="date"
                            id="input-20"
                            required>
                            </b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="4">
                        <b-form-group id="input-group-21" label="Status:" label-for="input-21">
                          <b-form-select class="mb-3" id="input-21" value="1">
                            <option value="" selected disabled>Select Status</option>
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                          </b-form-select>
                        </b-form-group>
                      </b-col>

                    </b-row>
                  </b-col>

          </b-row>
        </b-form>

        <div class="mt-4 clearfix">
            <div class="float-right">
              <b-button variant="maroon" size="md"><i class="fa fa-check"></i> Save</b-button>
            </div>
            <div class="float-left">
              <b-button variant="warning" size="md"><i class="fa fa-plus"></i> New</b-button>
            </div>
          </div>
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Widget from 'RESO/js/components/Widget/Widget';

export default {
  name: 'Users',
  components: { Widget },
  data() {
    return {
      message: 'Test message'
    }
  }
};
</script>
