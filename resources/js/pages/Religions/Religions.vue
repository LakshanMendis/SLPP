<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Religions</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Master - <span class="fw-semi-bold">Religions</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>
          <b-form id="formPersonal" @submit.stop.prevent="submitPersonal()">
                    <b-row>
                      <b-col md="6">
                        <b-form-group id="input-group-1" label="Caption:" label-for="input-1">
                          <b-form-input
                            id="input-1"
                            required
                            value=""
                            placeholder="Enter Caption"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-2" label="Religions (English):" label-for="input-2">
                          <b-form-input
                            id="input-2"
                            required
                            value=""
                            placeholder="Enter Religions (English)"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-3" label="Religions (සිංහල):" label-for="input-3">
                          <b-form-input
                            id="input-3"
                            required
                            value=""
                            placeholder="Enter Religions (සිංහල)"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-4" label="Religions (தமிழ்):" label-for="input-4">
                          <b-form-input
                            id="input-4"
                            required
                            value=""
                            placeholder="Enter Religions (தமிழ்)"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>

                      <b-col md="6">
                        <b-form-group id="input-group-5" label="Status:" label-for="input-5">
                          <b-form-select class="mb-3" id="input-5">
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
  name: 'Religions',
  components: { Widget },
  data() {
    return {
      message: 'Test message'
    }
  }
};
</script>
