<template>
  <a-menu
    v-model:openKeys="openKeys"
    v-model:selectedKeys="selectedKeys"
    mode="inline"
  >
    <a-menu-item key="admin-users">
      <router-link :to="{ name: 'admin-users' }">
        <span><UserOutlined class="me-1" /> Tài Khoản </span>
      </router-link>
    </a-menu-item>

    <a-menu-item key="admin-roles">
      <router-link :to="{ name: 'admin-roles' }">
        <span><TagOutlined class="me-1"/> Vai trò </span>
      </router-link>
    </a-menu-item>

    <a-menu-item key="admin-settings">
      <router-link :to="{ name: 'admin-settings' }">
        <span><SettingOutlined class="me-1"/> Cài đặt </span>
      </router-link>
    </a-menu-item>
  </a-menu>
</template>
  
<script>
import { defineComponent, reactive, toRefs } from "vue";
import { storeToRefs } from "pinia";
import { useMenu } from "../stores/use-menu.js";
import { UserOutlined, TagOutlined, SettingOutlined} from "@ant-design/icons-vue";
export default defineComponent({
  components: {
    UserOutlined,
    TagOutlined,
    SettingOutlined,
  },
  setup() {
    const store = useMenu();

    return {
      ...storeToRefs(store),
    };
  },
});
</script>