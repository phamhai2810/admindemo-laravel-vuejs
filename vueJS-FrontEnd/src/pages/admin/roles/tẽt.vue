function renderUser() {
  let element = `<tr>
      <th>ID</th>
      <th>Name</th>
    </tr>`;
  users.map(value => {
    element += `<tr>
      <td>${value.id}</td>
      <td>${value.name}</td>
    </tr>`;
  });
  document.getElementById("table").innerHTML = element;
}


<table cellpadding="15" cellspacing="8" border="1" id="table">
  <ul class="list-unstyled" v-for="user in users" :key="user.id">
    <li class="ui-state-default li-items mt-1">
      <input type="text" class="form-control" v-model="user.name" />
      <input type="text" class="form-control" v-model="user.em" />
    </li>
  </ul>

  <tr v-for="user in users" :key="user.id">
    <td>{{ user.name }}</td>
    <td>hi</td>
    <td>hello</td>
    <td>hi</td>
    <td>hello</td>
    <td>hi</td>
  </tr>
</table>


<template>
  <a-card title="Tai Khoan" style="width: 100%">
    <table>
      <tr>
        <th>ID</th>
        <th>Tên Tài Khoản</th>
        <th>Họ Và Tên</th>
        <th>Email</th>
        <th>Phòng Ban</th>
        <th>Vai Trò</th>
        <th>Tình Trạng</th>
      </tr>
      <tr v-for="user in users" :key="user.id">
        <td>{{ user.id }}</td>
        <td>{{ user.username }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.departments }}</td>
        <td>{{ user.role }}</td>
        <!-- Assuming user.role contains role information -->

        <td :style="{ color: getStatusColor(user.status) }">
          {{ user.status }}
        </td>
      </tr>
    </table>
  </a-card>
</template>

<script>
import axios from "axios";
import { useMenu } from "../../../stores/use-menu.js";

export default {
  name: "User",
  data: function () {
    return {
      users: [],
    };
  },
  created() {
    axios.get("http://127.0.0.1:8000/api/users").then((response) => {
      this.users = response.data.data;
    });
  },
  setup() {
    useMenu().onSelectedKeys(["admin-users"]);
  },
  methods: {
    getStatusColor(status) {
      if (status === 1) {
        return "green"; // Màu xanh lá
      } else if (status === 3) {
        return "red"; // Màu đỏ
      } else {
        return "black"; // Màu đen mặc định
      }
    },
  },
};
</script>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td,
th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.text-primary {
  color: green; /* Set the color you desire for text-primary class */
}
</style>
