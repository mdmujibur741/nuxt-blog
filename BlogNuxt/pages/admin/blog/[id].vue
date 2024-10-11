<template>
  <AppLayout>
 
    <VaCard v-if="blogData?.blog">
      <VaCardContent>
        <form @submit.prevent="submit">
          <div class="mb-3">
            <VaInput v-model="form.title"  label=" title" />
            <FormError v-if="errors" :errorInput="errors.title" />
           </div>
             <div class="mb-3">
              <VaInput v-model="form.subtitle"  label="subtitle" />
              <FormError v-if="errors" :errorInput="errors.subtitle" />
             </div>
             <div class="mb-3">
              <VaTextarea v-model="form.description" label="Description" class="w-full"/>
              <FormError v-if="errors" :errorInput="errors.description" />
             </div>
            <div class="mb-3">
              <VaInput type="number" v-model="form.priority"  label="Priority" />
              <FormError v-if="errors" :errorInput="errors.priority" />
            </div>
    
            <div class="mb-3">
            <label for="">category</label>
            <select class="w-full my-1 p-1 border"   v-model="form.category_id">
               <option v-for="cat in CatData" :key="cat.id"  :value="cat.id"> {{ cat.title }} </option>
            </select>
            <FormError v-if="errors" :errorInput="errors.category_id" />
            </div>
    
            <div class="mb-3">
              <VaFileUpload v-model="form.image"  undo type="gallery" undo-duration="500" undo-button-text="undoButtonText"  deleted-file-message="deletedFileMessage" />
            </div>
    
            <div class="flex justify-end">
                <p class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 justify-end items-start">
               <!-- <img v-for="img in blogData.blog?.blog_image" :key="img.id" :src="img.src" alt="">   -->
<VaImage v-for="img in blogData.blog?.blog_image" :key="img.id" fit="cover" class="max-w-32 col-span-1 bg-gray-300" :src="img.src"/> 
                </p>
            </div>

          <div class="flex justify-end gap-3">
            <VaButton color="secondary" preset="secondary">Cancel</VaButton>
            <VaButton @click="submit">Update</VaButton>
          </div>


        </form>
      </VaCardContent>
    </VaCard>
  </AppLayout>
</template>

<script setup>
import { useApiFetch } from "~/composable/useApiFetch";
import { usePermission } from "~/composable/usePermission";
import AppLayout from "~/layouts/AppLayout.vue";
import { ref, watch, computed } from "vue";
import { useToast, VaImage } from "vuestic-ui";
import { useRoute } from "vue-router";
import auth from "~/middleware/auth";

definePageMeta({
  middleware: auth,
});
const route = useRoute();
const Id = route.params.id;

const errors = ref({});
const { init, notify, close, closeAll } = useToast();

const { data:blogData, status:blogStatus, error:blogError, refresh:blogRefresh, clear:blogClear } = useApiFetch(`api/admin/blogs/${Id}`);
const {data: CatData, status: CatStatus,error: CatError, refresh: CatRefresh,clear: CatClear} = useApiFetch(`api/admin/category`);


const form = reactive({
  title:"",
  subtitle: "",
  description: "",
  priority: "",
  category_id : "",
  image: [],
});



watchEffect(() => {
  if (blogData.value?.blog) {
    form.title = blogData.value.blog.title || "";
    form.subtitle = blogData.value.blog.subtitle || "";
    form.description = blogData.value.blog.description || "";
    form.priority = blogData.value.blog.priority || "";
    form.category_id = blogData.value.blog?.category_id || "";
    form.image = blogData.value.blog.image || [];
  }
});

async function submit() {
  const { data, status, error } = await useApiFetch(`api/admin/blogs/${Id}`, {
    method: "put",
    body: form,
  });

  if (status.value === "error") {
    errors.value = error.value.data.errors;
  } else {
    notify("Blog Update Successfully");
    navigateTo("/admin/blog");
  }
}
</script>
