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
  name: 'Companies',
  components: { Widget },
  data() {
    return {
      message: 'Test message'
    }
  }
};
</script>
