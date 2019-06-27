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
          <b-col md="6">
                        <b-form-group id="input-group-1" label="*Membership ID:" label-for="input-1">
                          <b-form-input
                            id="input-1"
                            required
                            value=""
                            placeholder="Enter Membership ID"
                          ></b-form-input>
                        </b-form-group>
                      </b-col>
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
