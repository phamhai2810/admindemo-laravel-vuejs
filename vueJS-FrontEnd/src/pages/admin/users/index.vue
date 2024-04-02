<template>
  <a-card title="Tài khoản" style="width: 100%">
    <div class="row mb-3">
      <div class="col-12 d-flex justify-content-end">
        <a-button type="primary">
          <router-link :to="{ name: 'admin-users-create' }">
            <font-awesome-icon :icon="['fas', 'plus']" />
          </router-link>
        </a-button>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a-table :dataSource="users" :columns="columns" :scroll="{ x: 576 }">
          <template #bodyCell="{ column, index, record }">
            <template v-if="column.key === 'index'">
              <span>{{ index + 1 }}</span>
            </template>

            <template v-if="column.key === 'status'">
              <span v-if="record.status_id == 1" class="text-primary">{{
                record.status
              }}</span>
              <span v-else-if="record.status_id == 2" class="text-danger">{{
                record.status
              }}</span>
            </template>

            <template v-if="column.key === 'action'">
              <router-link
                :to="{ name: 'admin-users-edit', params: { id: record.id } }"
              >
                <a-button type="primary" class="me-sm-1 mb-2">
                  <font-awesome-icon :icon="['fas', 'pen-to-square']" />
                </a-button>
              </router-link>
              <a-button type="primary" danger @click="deleteUser(record.id)">
                <font-awesome-icon :icon="['fas', 'trash']" />
              </a-button>
            </template>
          </template>
        </a-table>
      </div>
    </div>
  </a-card>
</template>

<script>
import { createVNode, defineComponent, ref } from "vue";
import { ExclamationCircleOutlined } from "@ant-design/icons-vue";
import { useMenu } from "../../../stores/use-menu.js";
import { message } from "ant-design-vue"; //Lấy message để thông báo thành công
import { useRouter } from "vue-router"; //Chuyển trang bằng router
import { Modal } from "ant-design-vue";

export default defineComponent({
  setup() {
    useMenu().onSelectedKeys(["admin-users"]);

    const router = useRouter();
    const users = ref([]);
    const columns = [
      {
        title: "#",
        key: "index",
      },
      {
        title: "Avatar",
        key: "avatar",
      },
      {
        title: "Tài khoản",
        dataIndex: "username",
        key: "username",
      },
      {
        title: "Họ Tên",
        dataIndex: "name",
        key: "name",
      },
      {
        title: "Phòng ban",
        dataIndex: "departments",
        key: "departments",
        responsive: ["sm"],
      },
      {
        title: "Vai trò",
        key: "roles",
      },
      {
        title: "Tình trạng",
        dataIndex: "status",
        key: "status",
      },
      {
        title: "Công cụ",
        key: "action",
        fixed: "right",
      },
    ];

    const getUsers = () => {
      axios
        .get("http://127.0.0.1:8000/api/users")
        .then((response) => {
          users.value = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    };

    const deleteUser = (id) => {
      Modal.confirm({
        content: "Bạn có chắc chắn ?",
        icon: createVNode(ExclamationCircleOutlined),
        onOk() {
          axios
            .delete(`http://127.0.0.1:8000/api/delete/${id}`)
            .then((response) => {
              if (response.status == 200) {
                message.success("Xoá thành công");
                getUsers();
              }
            })
            .catch((error) => {
              console.log(error);
            });
        },
        cancelText: "Huỷ",
        onCancel() {
          Modal.destroyAll();
        },
      });
    };

    getUsers();

    return {
      users,
      columns,
      deleteUser,
    };
  },
});
</script>