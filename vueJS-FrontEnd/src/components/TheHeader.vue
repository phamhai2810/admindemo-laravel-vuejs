<template>
  <div class="container-fluild">
    <div class="row" style="background-color: #e0e0e0; padding: 1rem">
      <div
        class="col-1 d-flex d-sm-none align-items-center justify-content-center"
      >
        <span v-on:click="showDrawer"
          ><font-awesome-icon :icon="['fas', 'align-justify']"
        /></span>
      </div>
      <div
        class="col-10 col-sm-9 d-flex align-items-center justify-content-center justify-content-sm-start"
      >
        <img
          src="../assets/vue.svg"
          alt="logo"
          height="32"
          width="34"
          class="ms-3 me-3"
        />
        <span class="d-none d-sm-flex">Quản Trị Viên</span>
      </div>
      <div
        class="col-sm-3 d-none d-sm-flex align-items-center justify-content-sm-end"
      >
        <span>Admin</span>
      </div>
      <div
        class="col-1 d-flex d-sm-none align-items-center justify-content-center"
      >
        <span @click="showDrawerUser"
          ><font-awesome-icon :icon="['fas', 'user']"
        /></span>
      </div>
    </div>
  </div>
  <a-drawer
    v-model:open="open"
    class="custom-class"
    root-class-name="root-class-name"
    :root-style="{ color: 'blue' }"
    title="Danh Mục"
    placement="left"
  >
    <TheMenu />
  </a-drawer>

  <a-drawer
    v-model:open="open_user"
    class="custom-class"
    root-class-name="root-class-name"
    :root-style="{ color: 'blue' }"
    title="Admin"
    placement="right"
  >
    <p>Some contents...</p>
    <p>Some contents...</p>
    <p>Some contents...</p>
  </a-drawer>
</template>

<script setup>
import TheMenu from "../components/TheMenu.vue";
import { ref } from "vue";
const open = ref(false);
const open_user = ref(false);
const showDrawer = () => {
  open.value = true;
};
const showDrawerUser = () => {
  open_user.value = true;
};
</script>