<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>Template Update/Inactivate</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Template - <span class="fw-semi-bold">Update/Inactivate</span>
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
  name: 'AnotherPage',
  components: { Widget },
  data() {
    return {
      message: 'Template update or inactivate'
    }
  }
};
</script>
