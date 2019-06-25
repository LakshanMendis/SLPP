<template>
  <div>
    <b-breadcrumb>
      <b-breadcrumb-item>YOU ARE HERE</b-breadcrumb-item>
      <b-breadcrumb-item active>New Template</b-breadcrumb-item>
    </b-breadcrumb>
    <h1 class="page-title">
      Template - <span class="fw-semi-bold">Create New</span>
    </h1>

    <b-row>
      <b-col lg="12">
        <Widget>
          <b-row>
            <b-col md="6">
              <b-form-group id="input-group-1" label="Template Name:" label-for="input-1">
                <b-form-input
                  id="input-1"
                  required
                  placeholder="Enter template name"
                ></b-form-input>
              </b-form-group>
            </b-col>

            <b-col md="6">
              <b-form-group id="input-group-2" label="Template Language:" label-for="input-2">
                <b-form-select class="mb-3" id="input-2">
                  <option value="si">Sinhala</option>
                  <option value="en">English</option>
                  <option value="ta">Tamil</option>
                </b-form-select>
              </b-form-group>
            </b-col>
          </b-row>

          <ckeditor class="document-editor" :editor="editor" :config="editorConfig" @ready="onReady"></ckeditor>

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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document';

export default {
  name: 'TemplateNew',
  components: { 
    Widget
  },
  data() {
    return {
      editor: DecoupledEditor,
      editorConfig: {
        // The configuration of the editor.
      }
    }
  },
  methods: {
      onReady( editor )  {
          // Insert the toolbar before the editable area.
          editor.ui.getEditableElement().parentElement.insertBefore(
              editor.ui.view.toolbar.element,
              editor.ui.getEditableElement()
          );
      }
  }
};
</script>

<style src="./TemplateNew.scss" lang="scss" scoped />