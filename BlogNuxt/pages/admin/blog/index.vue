

<template>
  <AppLayout>
    <VaCard>
      <VaCardContent>
        <div class="va-table-responsive  mx-auto shadow-lg">
          <table class="va-table w-full">
            <thead>
              <tr>
                <th>Id</th>
                <th>Title</th>
                <th>SubTile</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="blog in data" :key="blog.id">
                <td>{{ blog.id }}</td>
                <td>{{ blog.title }}</td>
                <td>{{ blog.subtitle }}</td>
                <!-- <td>    <VaBadge v-for="role in user.roles" :key="role.id" :text="role.name"  color="success" class="mr-2" /> </td> -->
                <td>
                 <div class="flex justify-center gap-4">
                  <nuxt-link :to="`blog/${blog.id}`"><font-awesome-icon color="primary" :icon="['fas', 'pen-to-square']" /> </nuxt-link>
                  <button @click="DataDelete(blog.id)"> <font-awesome-icon class="text-red-600" :icon="['fas', 'trash']" />  </button>
                 </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </VaCardContent>
    </VaCard>
  </AppLayout>
</template>

<script setup>
import { useApiFetch } from "~/composable/useApiFetch";
import { usePermission } from "~/composable/usePermission";
import AppLayout from "~/layouts/AppLayout.vue";
import { ref, watch, computed } from "vue";
import { useAuthStore } from "~/stores/useAuth";
import { useToast, useModal } from 'vuestic-ui'

import auth from '~/middleware/auth';
 

 definePageMeta({
    middleware : auth
 })

const store = useAuthStore();
const { confirm } = useModal()

const { data, status, error, refresh:categoryFresh, clear } = useApiFetch("api/admin/blogs");

async function DataDelete(id)
{
  const agreed = await confirm({
    title: 'Delete user',
    message: 'Are you sure you want to delete ',
    okText: 'Delete',
    cancelText: 'Cancel',
    size: 'small',
    maxWidth: '380px',
  })
  if(agreed){
    const { data, status, error, refresh, clear } = useApiFetch(`api/admin/blogs/${id}`, {
     method: "Delete",
  });
  await categoryFresh();
  }

}

</script>


<style>
.va-table-responsive {
  overflow: auto;
}
</style>