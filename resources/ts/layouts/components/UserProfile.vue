<script setup lang="ts">
import { initialAbility } from '@/plugins/casl/ability';
import { useAppAbility } from '@/plugins/casl/useAppAbility';
import { PerfectScrollbar } from 'vue3-perfect-scrollbar';

import axios from 'axios';

import avatar1 from '@images/avatars/avatar-1.png';

const router = useRouter()
const ability = useAppAbility()
const userData = JSON.parse(localStorage.getItem('userData') || 'null')
const userDetail = JSON.parse(localStorage.getItem('userDetail') || 'null')
const accessToken = JSON.parse(localStorage.getItem('accessToken') || 'null')

const logout = () => {
  // // Remove "userData" from localStorage
  // localStorage.removeItem('userData')

  // // Remove "accessToken" from localStorage
  // localStorage.removeItem('accessToken')

  axios.get('api/auth/logout', {
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + accessToken,
      }
    })
  .then(r => {
      
    
    //console.log(r.data)
    // const Toast = Swal.mixin({
    //     toast: true,
    //     position: 'top-end',
    //     showConfirmButton: false,
    //     timer: 3000,
    //     timerProgressBar: true,
    //     didOpen: (toast) => {
    //       toast.addEventListener('mouseenter', Swal.stopTimer)
    //       toast.addEventListener('mouseleave', Swal.resumeTimer)
    //     }
    //   })
    //   Toast.fire({
    //     icon: 'success',
    //     title: r.data.message,
    //   })
    // Remove "userData" from localStorage
    localStorage.removeItem('userData')
    localStorage.removeItem('userDetail')
    // Remove "accessToken" from localStorage
    localStorage.removeItem('accessToken')
  
    // Redirect to login page
    router.push('/login')
      .then(() => {
        // ℹ️ We had to remove abilities in then block because if we don't nav menu items mutation is visible while redirecting user to login page
        // Remove "userAbilities" from localStorage
        localStorage.removeItem('userRole')
        localStorage.removeItem('userAbilities')
        // Reset ability to initial ability
        ability.update(initialAbility)
        
      })
    
  })
  .catch(error => {
        // handle error
        //console.log(accessToken);
        console.log(error);
      });
  

}

const userProfileList = [
  { type: 'divider' },
  { type: 'navItem', icon: 'tabler-user', title: 'Profile', to: { name: 'pages-user-profile-tab', params: { tab:'profile' , id: userData.id } } },
  { type: 'navItem', icon: 'tabler-settings', title: 'Settings', to: { name: 'pages-account-settings-tab', params: { tab: 'account' } } },
  { type: 'navItem', icon: 'tabler-credit-card', title: 'Billing', to: { name: 'pages-account-settings-tab', params: { tab: 'billing-plans' } }, badgeProps: { color: 'error', content: '3' } },
  { type: 'divider' },
  { type: 'navItem', icon: 'tabler-lifebuoy', title: 'Help', to: { name: 'pages-help-center' } },
  { type: 'navItem', icon: 'tabler-currency-dollar', title: 'Pricing', to: { name: 'pages-pricing' } },
  { type: 'navItem', icon: 'tabler-help', title: 'FAQ', to: { name: 'pages-faq' } },
  { type: 'divider' },
  { type: 'navItem', icon: 'tabler-logout', title: 'Logout', onClick: logout },
]
</script>

<template>
  <VBadge
    dot
    bordered
    location="bottom right"
    offset-x="3"
    offset-y="3"
    color="success"
  >
    <VAvatar
      class="cursor-pointer"
      :color="!(userDetail && userDetail.avatar) ? 'primary' : undefined"
      :variant="!(userDetail && userDetail.avatar) ? 'tonal' : undefined"
    >
      <VImg
        v-if="userDetail && userDetail.avatar"
        :src="avatar1"
      />
      <VIcon
        v-else
        icon="tabler-user"
      />

      <!-- SECTION Menu -->
      <VMenu
        activator="parent"
        width="230"
        location="bottom end"
        offset="14px"
      >
        <VList>
          <VListItem>
            <template #prepend>
              <VListItemAction start>
                <VBadge
                  dot
                  location="bottom right"
                  offset-x="3"
                  offset-y="3"
                  color="success"
                  bordered
                >
                  <VAvatar
                    :color="!(userDetail && userDetail.avatar) ? 'primary' : undefined"
                    :variant="!(userDetail && userDetail.avatar) ? 'tonal' : undefined"
                  >
                    <VImg
                      v-if="userDetail && userDetail.avatar"
                      :src="userDetail.avatar"
                    />
                    <VIcon
                      v-else
                      icon="tabler-user"
                    />
                  </VAvatar>
                </VBadge>
              </VListItemAction>
            </template>

            <VListItemTitle class="font-weight-medium">
              {{ userDetail.first_name || userData.username }}
            </VListItemTitle>
            <VListItemSubtitle>{{ userData.role.name }}</VListItemSubtitle>
          </VListItem>

          <PerfectScrollbar :options="{ wheelPropagation: false }">
            <template
              v-for="item in userProfileList"
              :key="item.title"
            >
              <VListItem
                v-if="item.type === 'navItem'"
                :to="item.to"
                @click="item.onClick && item.onClick()"
              >
                <template #prepend>
                  <VIcon
                    class="me-2"
                    :icon="item.icon"
                    size="22"
                  />
                </template>

                <VListItemTitle>{{ item.title }}</VListItemTitle>

                <template
                  v-if="item.badgeProps"
                  #append
                >
                  <VBadge v-bind="item.badgeProps" />
                </template>
              </VListItem>

              <VDivider
                v-else
                class="my-2"
              />
            </template>
          </PerfectScrollbar>
        </VList>
      </VMenu>
      <!-- !SECTION -->
    </VAvatar>
  </VBadge>
</template>
