<script setup lang="ts">
import { initialAbility } from '@/plugins/casl/ability';
import { useAppAbility } from '@/plugins/casl/useAppAbility';
import axios from 'axios';

import Swal from 'sweetalert2';
import 'sweetalert2/src/sweetalert2.scss';

const router = useRouter()
const ability = useAppAbility()
const userData = JSON.parse(localStorage.getItem('userData') || 'null')
const userDetail = JSON.parse(localStorage.getItem('userDetail') || 'null')
const accessToken = JSON.parse(localStorage.getItem('accessToken') || 'null')

const logout = () => {

  



  axios.get('api/auth/logout', {
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + accessToken,
      }
    })
  .then(r => {


      
    
    //console.log(r.data)
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'success',
        title: r.data.message,
      })

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
</script>

<template>
  <VBadge
    dot
    location="bottom right"
    offset-x="3"
    offset-y="3"
    bordered
    color="success"
  >
    <VAvatar
      class="cursor-pointer"
      color="primary"
      variant="tonal"
    >
      <VImg
        v-if="userDetail && userDetail.avatar"
        :src="userDetail.avatar"
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
          <!-- 👉 User Avatar & Name -->
          <VListItem>
            <template #prepend>
              <VListItemAction start>
                <VBadge
                  dot
                  location="bottom right"
                  offset-x="3"
                  offset-y="3"
                  color="success"
                >
                  <VAvatar
                    color="primary"
                    variant="tonal"
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

            <VListItemTitle class="font-weight-semibold">
              {{ userData.name }}
            </VListItemTitle>
            <VListItemSubtitle>{{ userData.role.name }}</VListItemSubtitle>
          </VListItem>

          <VDivider class="my-2" />

          <!-- 👉 Profile -->
          <VListItem :to="{ name: 'apps-user-view-id', params: { id: 1 } }">
            <template #prepend>
              <VIcon
                class="me-2"
                icon="tabler-user"
                size="22"
              />
            </template>

            <VListItemTitle>Profile</VListItemTitle>
          </VListItem>

          <!-- 👉 Settings -->
          <VListItem :to="{ name: 'pages-account-settings-tab', params: { tab: 'account' } }">
            <template #prepend>
              <VIcon
                class="me-2"
                icon="tabler-settings"
                size="22"
              />
            </template>

            <VListItemTitle>Settings</VListItemTitle>
          </VListItem>

          <!-- 👉 Pricing -->
          <VListItem :to="{ name: 'pages-pricing' }">
            <template #prepend>
              <VIcon
                class="me-2"
                icon="tabler-currency-dollar"
                size="22"
              />
            </template>

            <VListItemTitle>Pricing</VListItemTitle>
          </VListItem>

          <!-- 👉 FAQ -->
          <VListItem :to="{ name: 'pages-faq' }">
            <template #prepend>
              <VIcon
                class="me-2"
                icon="tabler-help"
                size="22"
              />
            </template>

            <VListItemTitle>FAQ</VListItemTitle>
          </VListItem>

          <!-- Divider -->
          <VDivider class="my-2" />

          <!-- 👉 Logout -->
          <VListItem
            link
            @click="logout"
          >
            <template #prepend>
              <VIcon
                class="me-2"
                icon="tabler-logout"
                size="22"
              />
            </template>

            <VListItemTitle>Logout</VListItemTitle>
          </VListItem>
        </VList>
      </VMenu>
      <!-- !SECTION -->
    </VAvatar>
  </VBadge>
</template>
