<script lang="ts" setup>

import avatar1 from '@images/avatars/avatar-1.png';
import UserProfileHeaderBg from '@images/pages/user-profile-header-bg.png';

const userData = JSON.parse(localStorage.getItem('userData') || 'null')
const userDetail = JSON.parse(localStorage.getItem('userDetail') || 'null')



</script>

<template>
  
  <VCard v-if="userData">
    <VImg
      
      :src="UserProfileHeaderBg"
      min-height="125"
      max-height="250"
      cover
    />

    <VCardText class="d-flex align-bottom flex-sm-row flex-column justify-center gap-x-5">
      <div class="d-flex h-0">
        <VAvatar
          rounded
          size="120"
          :image="avatar1"
          class="user-profile-avatar mx-auto"
        />
      </div>

      <div class="user-profile-info w-100 mt-16 pt-6 pt-sm-0 mt-sm-0">
        <h6 class="text-h6 text-center text-sm-start font-weight-medium mb-3">
          {{ userData?.username }}
        </h6>

        <div class="d-flex align-center justify-center justify-sm-space-between flex-wrap gap-4">
          <div class="d-flex flex-wrap justify-center justify-sm-start flex-grow-1 gap-2">
            <span class="d-flex">
              <VIcon
                size="20"
                icon="tabler-color-swatch"
                class="me-1"
              />
              <span class="text-body-1">
                {{ userData?.user_detail.job_title }}
              </span>
            </span>

            <span class="d-flex align-center">
              <VIcon
                size="20"
                icon="tabler-map-pin"
                class="me-2"
              />
              <span class="text-body-1">
                {{ userData?.user_detail.city }}
              </span>
            </span>

            <span class="d-flex align-center">
              <VIcon
                size="20"
                icon="tabler-calendar"
                class="me-2"
              />
              <span class="text-body-1">
                {{ userData?.created_at }}
              </span>
            </span>
          </div>

          <VBtn prepend-icon="tabler-check">
            Connected
          </VBtn>
        </div>
      </div>
    </VCardText>
  </VCard>



</template>

<style lang="scss">
.user-profile-avatar {
  border: 5px solid rgb(var(--v-theme-surface));
  background-color: rgb(var(--v-theme-surface)) !important;
  inset-block-start: -3rem;

  .v-img__img {
    border-radius: 0.125rem;
  }
}
</style>
