<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Departments</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Master - <span class="fw-semi-bold">Departments</span>
    </h1>

    <b-row>
      <b-col lg="6">
        <Widget>
          {{message}}
        </Widget>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import Widget from 'RESO/js/components/Widget/Widget';

export default {
  name: 'Departments',
  components: { Widget },
  data() {
    return {
      message: 'Test message'
    }
  }
};
</script>
