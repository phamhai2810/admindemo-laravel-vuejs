<template>Day la quan ly setting</template>

<script>
import { useMenu } from "../../../stores/use-menu.js";
export default {
  setup() {
    const store = useMenu();
    store.onSelectedKeys(["admin-settings"]);
  },
};
</script>