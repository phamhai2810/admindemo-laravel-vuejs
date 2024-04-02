<template>
  <table cellpadding="15" cellspacing="8" border="1" id="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="user in users" :key="user.id">
        <td>{{ user.id }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import axios from "axios";
import { useMenu } from "../../../stores/use-menu.js";
import { ref } from "vue";

export default {
  setup() {
    useMenu().onSelectedKeys(["admin-users"]);

    const users = ref([]);

    async function getUsers() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/users");
        users.value = response.data;
        console.log(users.value);
      } catch (e) {
        console.log(e);
      }
    }

    getUsers();

    return {
      users,
    };
  },
};
</script>