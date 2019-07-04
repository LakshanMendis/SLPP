<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Companies</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Master - <span class="fw-semi-bold">Companies</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>
          <b-form id="formPersonal" @submit.stop.prevent="submitPersonal()">
          <b-row>

            <legend><i class="fa fa-angle-right"></i> Logo</legend>

                      <b-col md="4 p-4 bg-dark">
                      <b-row>
                        <b-col md="12" class="pb-1">
                          <b-img thumbnail fluid src="http://leadership.hscni.net/Images/Uploads/anon_user.png" alt="Image 1"></b-img>
                        </b-col>
                      </b-row>

                      <b-row>
                        <b-col md="12">
                          <b-form-file
                            placeholder="Upload Logo..."
                            drop-placeholder="Drop file here..."
                          ></b-form-file>
                        </b-col>
                      </b-row>
                      </b-col>

                      <legend><i class="fa fa-angle-right"></i> Company Details</legend>

                      <b-col md="6">
                        <b-form-group id="input-group-1" label="Full Name:" label-for="input-1">
                          <b-form-input
                            id="input-1"
                            required
                            value=""
                            placeholder="Enter Full Name"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-2" label="*Short Name:" label-for="input-2">
                          <b-form-input
                            id="input-2"
                            required
                            value=""
                            placeholder="Enter Short Name"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="12">
                        <b-form-group id="input-group-3" label="Slogan:" label-for="input-3">
                          <b-form-input
                            id="input-3"
                            required
                            value=""
                            placeholder="Enter Slogan"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <!-- <b-col md="6">
                        <b-form-group id="input-group-4" label="Logo Large:" label-for="input-4">
                          <b-form-input
                            id="input-4"
                            required
                            value=""
                            placeholder="Enter Logo Large"
                          ></b-form-input>
                        </b-form-group>
                      </b-col> -->

                      <!-- <b-col md="6">
                        <b-form-group id="input-group-5" label="Logo Medium:" label-for="input-5">
                          <b-form-input
                            id="input-5"
                            required
                            value=""
                            placeholder="Enter Logo Medium"
                          ></b-form-input>
                        </b-form-group>
                      </b-col> -->

                      <!-- <b-col md="6">
                        <b-form-group id="input-group-6" label="Logo Small:" label-for="input-6">
                          <b-form-input
                            id="input-6"
                            required
                            value=""
                            placeholder="Enter Logo Small"
                          ></b-form-input>
                        </b-form-group>
                      </b-col> -->

                      <legend><i class="fa fa-angle-right"></i> Address</legend>

                      <b-col md="6">
                        <b-form-group id="input-group-7" label="Address 1:" label-for="input-7">
                          <b-form-input
                            id="input-7"
                            required
                            value=""
                            placeholder="Enter Address Line 1"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-8" label="Address 2:" label-for="input-8">
                          <b-form-input
                            id="input-8"
                            required
                            value=""
                            placeholder="Enter Address Line 2"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-9" label="Address 3:" label-for="input-9">
                          <b-form-input
                            id="input-9"
                            required
                            value=""
                            placeholder="Enter Address Line 1"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-10" label="City:" label-for="input-10">
                          <b-form-input
                            id="input-10"
                            required
                            value=""
                            placeholder="Enter City"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-11" label="Country:" label-for="input-11">
                          <b-form-input
                            id="input-11"
                            required
                            value=""
                            placeholder="Enter Country"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
                      
                      <b-col md="6">
                        <b-form-group id="input-group-12" label="Hotline:" label-for="input-12">
                          <b-form-input
                            id="input-12"
                            required
                            value=""
                            placeholder="Enter Hotline"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <legend><i class="fa fa-angle-right"></i> Contact</legend>

                      <b-col md="6">
                        <b-form-group id="input-group-13" label="Telephone 1:" label-for="input-13">
                          <b-form-input
                            id="input-13"
                            required
                            value=""
                            placeholder="Enter Telephone 1"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-14" label="Telephone 2:" label-for="input-14">
                          <b-form-input
                            id="input-14"
                            required
                            value=""
                            placeholder="Enter Telephone 2"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-15" label="Telephone 3:" label-for="input-15">
                          <b-form-input
                            id="input-15"
                            required
                            value=""
                            placeholder="Enter Telephone 3"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-16" label="Fax 1:" label-for="input-16">
                          <b-form-input
                            id="input-16"
                            required
                            value=""
                            placeholder="Enter Fax 1"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-17" label="Fax 2:" label-for="input-17">
                          <b-form-input
                            id="input-17"
                            required
                            value=""
                            placeholder="Enter Fax 2"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-18" label="Fax 3:" label-for="input-18">
                          <b-form-input
                            id="input-18"
                            required
                            value=""
                            placeholder="Enter Fax 3"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-19" label="Email:" label-for="input-19">
                          <b-form-input
                            id="input-19"
                            required
                            value=""
                            placeholder="Enter Email"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-20" label="Corporate Code:" label-for="input-20">
                          <b-form-input
                            id="input-20"
                            required
                            value=""
                            placeholder="Enter Corporate Code"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <legend><i class="fa fa-angle-right"></i> Business Details</legend>

                      <b-col md="6">
                        <b-form-group id="input-group-21" label="Business Registration:" label-for="input-21">
                          <b-form-input
                            id="input-21"
                            required
                            value=""
                            placeholder="Enter Business Registration"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-22" label="VAT Registration:" label-for="input-22">
                          <b-form-input
                            id="input-22"
                            required
                            value=""
                            placeholder="Enter VAT Registration"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-23" label="SVAT Registration:" label-for="input-23">
                          <b-form-input
                            id="input-23"
                            required
                            value=""
                            placeholder="Enter SVAT Registration"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-24" label="Status:" label-for="input-24">
                          <b-form-select class="mb-3" id="input-24">
                            <option value="" selected disabled>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </b-form-select>
                        </b-form-group>
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
  name: 'Companies',
  components: { Widget },
  data() {
    return {
      message: 'Test message'
    }
  }
};
</script>
