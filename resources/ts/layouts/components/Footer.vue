<template>
  <div class="h-100 d-flex align-center justify-space-between">
    <!-- 👉 Footer: left content -->
    <span class="d-flex align-center">
      &copy;
      {{ new Date().getFullYear() }}
      Made With
      <VIcon
        icon="tabler-heart"
        color="error"
        size="1.25rem"
        class="mx-1"
      />
      By <a
        href="https://luxima.id"
        target="_blank"
        rel="noopener noreferrer"
        class="text-primary ms-1"
      >LUXIMA.ID</a>
    </span>
    <!-- 👉 Footer: right content -->
    <span class="d-md-flex gap-x-4 text-primary d-none">
      <a
        href="https://luxima-id.com"
        target="noopener noreferrer"
      >Main Website</a>
      <a
        href="https://luxima-id.com/link"
        target="noopener noreferrer"
      >Links</a>
      <a
        href="https://crm.luxima.id"
        target="noopener noreferrer"
      >Client Area</a>
    </span>
  </div>
</template>
