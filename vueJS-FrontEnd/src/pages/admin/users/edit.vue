<template>
  <form @submit.prevent="updateUsers()">
    <a-card title="Cập nhật tài khoản" style="width: 100%">
      <div class="row">
        <div class="col-12 col-sm-4">
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
              <a-avatar shape="square" :size="200">
                <template #icon>
                  <img src="../../../assets/vue.svg" alt="Avatar" />
                </template>
              </a-avatar>
            </div>
            <div class="col-12 d-flex justify-content-center">
              <a-button type="primary">
                <font-awesome-icon :icon="['fas', 'plus']" class="me-2" />
                <span> Chọn ảnh </span>
              </a-button>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-8">
          <div class="row mb-3">
            <div class="col-12 col-sm-4 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.status_id,
                  }"
                  >Tình trạng:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-select
                show-search
                placeholder="Tình trạng"
                style="width: 100%"
                :options="users_status"
                :filter-option="filterOption"
                allowClear
                v-model:value="status_id"
                :class="{ 'select-danger': errors.status_id }"
              ></a-select>
              <div class="w-100"></div>
              <small v-if="errors.status_id" class="text-danger">{{
                errors.status_id[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-4 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.username,
                  }"
                  >Tên tài khoản:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-input
                placeholder="Tên tài khoản"
                allow-clear
                v-model:value="username"
                :class="{ 'input-danger': errors.username }"
              />
              <div class="w-100"></div>
              <small v-if="errors.username" class="text-danger">{{
                errors.username[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-4 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.name,
                  }"
                  >Họ tên:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-input
                placeholder="Họ tên"
                allow-clear
                v-model:value="name"
                :class="{ 'input-danger': errors.name }"
              />
              <div class="w-100"></div>
              <small v-if="errors.name" class="text-danger">{{
                errors.name[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-4 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.email,
                  }"
                  >Email:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-input
                placeholder="Email"
                allow-clear
                v-model:value="email"
                :class="{ 'input-danger': errors.email }"
              />
              <div class="w-100"></div>
              <small v-if="errors.email" class="text-danger">{{
                errors.email[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-4 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.department_id,
                  }"
                  >Phòng ban:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-select
                show-search
                placeholder="Phòng ban"
                style="width: 100%"
                :options="departments"
                :filter-option="filterOption"
                allowClear
                v-model:value="department_id"
                :class="{ 'select-danger': errors.department_id }"
              ></a-select>
              <div class="w-100"></div>
              <small v-if="errors.department_id" class="text-danger">{{
                errors.department_id[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-4 text-start text-sm-end"></div>

            <div class="col-12 col-sm-5">
              <a-checkbox v-model:checked="change_password"
                >Đổi mật khẩu</a-checkbox
              >
            </div>
          </div>

          <div class="row mb-3" v-if="change_password == true">
            <div class="col-12 col-sm-4 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.password,
                  }"
                  >Mật khẩu:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-input-password
                placeholder="Mật khẩu"
                allow-clear
                v-model:value="password"
                :class="{ 'input-danger': errors.password }"
              />
              <div class="w-100"></div>
              <small v-if="errors.password" class="text-danger">{{
                errors.password[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-3" v-if="change_password == true">
            <div class="col-12 col-sm-4 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span
                  :class="{
                    'text-danger': errors.password_confirmation,
                  }"
                  >Xác nhận mật khẩu:</span
                >
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <a-input-password
                placeholder="Xác nhận mật khẩu"
                allow-clear
                v-model:value="password_confirmation"
                :class="{ 'input-danger': errors.password_confirmation }"
              />
              <div class="w-100"></div>
              <small v-if="errors.password_confirmation" class="text-danger">{{
                errors.password_confirmation[0]
              }}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-4 text-start text-sm-end">
              <label>
                <span>Lần đăng nhập gần đây:</span>
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <span>{{ login_at }}</span>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-4 text-start text-sm-end">
              <label>
                <span>Lần đổi mật khẩu gần đây:</span>
              </label>
            </div>

            <div class="col-12 col-sm-5">
              <span>{{ change_password_at }}</span>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 d-grid mx-auto d-sm-flex justify-content-sm-end">
          <a-button class="me-0 me-sm-2 mb-3 mb-sm-0">
            <router-link :to="{ name: 'admin-users' }">
              <Span>Huỷ</Span>
            </router-link>
          </a-button>
          <a-button type="primary" htmlType="submit">
            <Span>Lưu</Span>
          </a-button>
        </div>
      </div>
    </a-card>
  </form>
</template>
  
  <script>
import { useMenu } from "../../../stores/use-menu.js"; //đồng bộ dữ liệu bằng pinia
import { defineComponent, ref, reactive, toRefs } from "vue";
import { message } from "ant-design-vue"; //Lấy message để thông báo thành công
import axios from "axios"; //Lấy Api
import { useRouter } from "vue-router"; //Chuyển trang bằng router
import { useRoute } from "vue-router";
export default defineComponent({
  setup() {
    useMenu().onSelectedKeys(["admin-users"]);

    //Tìm kiếm dữ liệu trong select khi người dùng nhập tay để tìm kiếm
    const filterOption = (input, option) => {
      return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
    };

    const router = useRouter();
    const route = useRoute();
    const users_status = ref([]);
    const departments = ref([]);
    const errors = ref({});

    //Tạo dữ liệu theo method reactive
    const users = reactive({
      username: "",
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      department_id: [],
      status_id: [],
      change_password: false,
      login_at: "",
      change_password_at: "",
    });

    const updateUsers = () => {
      axios
        .put(`http://127.0.0.1:8000/api/users/update/${route.params.id}`, users)
        .then((response) => {
          if (response.status == 200) {
            message.success("Cập nhật thành công");
            router.push({ name: "admin-users" });
          }
        })
        .catch((error) => {
          errors.value = error.response.data.errors;
        });
    };

    const getUserEdit = () => {
      console.log(`Users đang truy xuất có id là: ${route.params.id}`);
      axios
        .get(`http://127.0.0.1:8000/api/users/${route.params.id}/edit`)
        .then((response) => {
          users.username = response.data.users.username;
          users.name = response.data.users.name;
          users.email = response.data.users.email;
          users.department_id = response.data.users.department_id;
          users.status_id = response.data.users.status_id;

          response.data.users.change_password_at
            ? (users.login_at = response.data.users.login_at)
            : (users.login_at = "Chưa có lượt đăng nhập");

          response.data.users.change_password_at
            ? (users.change_password_at =
                response.data.users.change_password_at)
            : (users.change_password_at = "Chưa có lượt đổi mật khẩu");

          users_status.value = response.data.users_status;
          departments.value = response.data.departments;
        })
        .catch((error) => {
          console.log(error);
        });
    };
    getUserEdit();

    return {
      users_status,
      departments,
      ...toRefs(users),
      errors,
      filterOption,
      updateUsers,
    };
  },
});
</script>
  
  <style>
.select-danger {
  border: 1px solid red;
  border-radius: 8px;
}
.input-danger {
  border-color: red;
}
</style>