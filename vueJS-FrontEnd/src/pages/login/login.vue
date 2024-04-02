<template>
    <a-card title="Login" style="width: 300px; margin: auto;">
      <a-form
        :model="formState"
        name="basic"
        :label-col="{ span: 8 }"
        :wrapper-col="{ span: 16 }"
        autocomplete="off"
        @finish="onFinish"
        @finishFailed="onFinishFailed"
      >
        <a-form-item
          label="Username"
          name="username"
          :rules="[{ required: true, message: 'Please input your username!' }]"
        >
          <a-input v-model:value="formState.username" prefix-icon="user" placeholder="Username" />
        </a-form-item>
    
        <a-form-item
          label="Password"
          name="password"
          :rules="[{ required: true, message: 'Please input your password!' }]"
        >
          <a-input-password v-model:value="formState.password" prefix-icon="lock" placeholder="Password" />
        </a-form-item>
    
        <a-form-item name="remember" :wrapper-col="{ offset: 8, span: 16 }">
          <a-checkbox v-model:checked="formState.remember">Remember me</a-checkbox>
        </a-form-item>
    
        <a-form-item :wrapper-col="{ offset: 8, span: 16 }">
          <a-button type="primary" html-type="submit" style="width: 100%">Submit</a-button>
        </a-form-item>
      </a-form>
    </a-card>
  </template>
  
  <script>
  import { defineComponent, reactive } from 'vue';
  import { Card, Form, Input, Checkbox, Button } from 'ant-design-vue';
  
  export default defineComponent({
    components: {
      'a-card': Card,
      'a-form': Form,
      'a-form-item': Form.Item,
      'a-input': Input,
      'a-input-password': Input.Password,
      'a-checkbox': Checkbox,
      'a-button': Button
    },
    setup() {
      const formState = reactive({
        username: '',
        password: '',
        remember: true,
      });
      const onFinish = values => {
        console.log('Success:', values);
      };
      const onFinishFailed = errorInfo => {
        console.log('Failed:', errorInfo);
      };
      return {
        formState,
        onFinish,
        onFinishFailed,
      };
    },
  });
  </script>
  
  <style scoped>
  .ant-card {
    margin-top: 100px;
  }
  </style>