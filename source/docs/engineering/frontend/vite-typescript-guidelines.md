---
title: Panduan Vite Typescript
description: Panduan Vite Typescript
extends: _layouts.documentation
section: content
---

# Panduan Vite Typescript

## How To Run

### Development

1. Jalankan perintah `pnpm run dev --port=3000` pada terminal.
2. Buka browser dan akses alamat yang ditampilkan (biasanya `http://localhost:3000`).

### Production

1. Jalankan perintah `npm -g install serve`
2. Jalankan perintah `pnpm run build` untuk membuat build production.
3. File build akan berada di dalam folder `dist`.
4. Jalankan perintah `serve -s dist`

## Library

- Use **react-query** for fetcher library with `useQuery` or `useMutation`.
- Use **ant design** for form state library.

## Tips & Trick

- **Minimize `useEffect` usage:** Refer to [You Might Not Need an Effect](https://react.dev/learn/you-might-not-need-an-effect).
- **Code Splitting:** Manfaatkan dynamic import untuk code splitting.
- **Memoization:** Gunakan `React.memo` untuk mencegah re-render komponen yang tidak perlu.

## File Naming Convention

- **Hooks:** `[nama-hooks].ts` dan context-aware (`e.g., use-users-query.ts`)
- **Page Components:** `[nama-page].tsx` (e.g., `users.tsx`, `[id].tsx`). Untuk page yang berada di dalam folder, gunakan `page.tsx`.
- **Global Components:** `[nama-component].tsx` (e.g., `navbar.tsx`, `footer.tsx`).
- **Utils:** `[nama-utils].ts` (e.g., `date-formatter.ts`, `api-client.ts`).
- **Constants:** `[nama-constants].ts` (e.g., `api-endpoints.ts`, `form-config.ts`).

## Folder Structure

- `src/app/`: Application logic, including components, pages, and API routes.
  - `_components/`: Shared components.
  - `_hooks` : Shared hooks.
  - `(authenticated)/`: Components and pages requiring authentication. See [[Vite Development Guideline#Module Structure]] for more details.
  - `(public)/`: Publicly accessible components and pages. See [[Vite Development Guideline#Module Structure]] for more details
  - `api/`: API routes.
- `src/common/`: Common utilities, global type, enum, constant e.g `src/common/types/response.ts`
- `src/libs/`: Libraries and utilities.
- `src/types/`: Declared type e.g: `src/types/react-slider.d.ts`
- `src/utils/`: Utility functions.
- `src/api/`: API and its type definitions.
- `src/middleware.ts`: Middleware functions.

Overview:

```gherkin
└── src/
    ├── app/
    │   ├── _components/
    │   ├── (authenticated)/
    │   │   └── path/
    │   │       ├── _components/
    │   │       ├── _hooks/
    │   │       ├── _types/
    │   │       └── path/
    │   │           ├── _components/
    │   │           ├── _hooks/
    │   │           ├── _types/
    │   │           └── page.tsx
    │   ├── (public)/
    │   │   └── path/
    │   │       ├── _components/
    │   │       ├── _hooks/
    │   │       └── path/
    │   │           └── page.tsx
    │   └── api/
    ├── common/
    │   ├── enums/
    │   ├── constants/
    │   └── types/
    ├── libs/
    ├── types/
    ├── utils/
    ├── api/
    └── middleware.ts
```

## Module Structure

- `_components/`: Components within the module.
- `_hooks/`: Hooks within the module.
- `_const/`: Constant within the module
- `_utils/`: Utils within the module
- `page.ts`: Page component

## Module Page Path Naming

- Create: `/create`
- Update: `/[id]/update`
- List: `/`
- Detail `/[id]`

## How to create a module

1. **Tentukan Nama dan Lokasi Module:**

      - Pilih nama yang deskriptif dan sesuai dengan fungsinya.
      - Tentukan apakah module tersebut berada di dalam `(authenticated)` atau `(public)` route.
      - Buat folder di dalam route yang sesuai (misalnya, `src/app/(authenticated)/users`).

2. **Buat File `page.tsx`:**

      - File ini akan menjadi entry point untuk module Anda.
      - Implementasikan UI dan logika utama di dalam file ini.

   ```typescript
   // src/app/(authenticated)/users/page.tsx
   import React from "react";
   import { Page } from "admiral";
   const UsersPage = () => {
     return <Page title="List User">{/* ...Implementasi UI... */}</Page>;
   };

   export default UsersPage;
   ```

3. **Buat Constants (Jika Diperlukan):**

      - Jika module Anda memiliki konstanta, buat folder `_const` di dalam module Anda.
      - Letakkan konstanta tersebut di dalam folder `_const`.

   ```typescript
   // src/app/(authenticated)/users/_const/user-status-color.ts
   export const USER_STATUS_COLOR = {
     PENDING: "processing",
     SUCCESS: "success",
     ERROR: "error",
   };
   ```

4. **Buat Komponen Pendukung (Jika Diperlukan):**

      - Jika module Anda memiliki komponen yang kompleks atau digunakan kembali, buat folder `_components` di dalam module Anda.
      - Letakkan komponen-komponen tersebut di dalam folder `_components`.

   ```typescript
   // src/app/(authenticated)/users/_components/user-datatable.tsx
   import React from "react";
   import { Tag } from "antd";
   import Datatable from "admiral/table/datatable/index";
   import { ColumnsType } from "antd/es/table";
   import { TUserItemList } from "@/api/user/type";
   import { USER_STATUS_COLOR } from "../../_const/user-status-color";

   const columns: ColumnsType<TUserItemList> = [
     /*...*/
     {
       dataIndex: "status",
       title: "Status",
       key: "status",
       sorter: true,
       sortOrder: makeSortOrder(filters, "is_active"),
       render: (status) => {
         return <Tag color={USER_STATUS_COLOR[status]}>{status}</Tag>;
       },
     },
     /*...*/
   ];

   const UserDatatable: typeof Datatable = (props) => {
     return <Datatable columns={columns} {...props} />;
   };

   export default UserList;
   ```

5. **Buat Hooks (Jika Diperlukan):**

      - Jika module Anda memiliki logika yang kompleks atau digunakan kembali, buat folder `_hooks` di dalam module Anda.
      - Letakkan hooks tersebut di dalam folder `_hooks`.

   ```typescript
   // src/app/(authenticated)/users/_hooks/use-users-query.ts
    import { getUsers } from "@/api/user";
    import { TGetUsersParams } from "@/api/user/type";
    import { useQuery } from "@/app/_hooks/request/use-query";
    export const useUsersQuery = (params: TGetUsersParams) => {
    return useQuery({
    queryKey: ["users", params],
    queryFn: () => getUsers(params),
    });
    };
    ```

1. **Buat Utils (Jika Diperlukan):**

      - Jika module Anda memiliki fungsi utilitas, buat folder `_utils` di dalam module Anda.
      - Letakkan fungsi utilitas tersebut di dalam folder `_utils`.

  ```typescript
  // src/app/(authenticated)/users/_utils/format-user.ts
  const formatUser = (user) => {
    return {
      ...user,
      fullName: `${user.firstName} ${user.lastName}`,
    };
  };

  export default formatUser;
  ```

1. **Overview `page.tsx`:**

      - Import komponen, hooks, utils, atau konstanta yang Anda buat di dalam file `page.tsx`.
      - Gunakan komponen, hooks, utils, atau konstanta tersebut untuk mengimplementasikan UI dan logika module Anda.

   ```typescript
   // src/app/(authenticated)/users/page.tsx
   import React from "react";
   import UserDatatable from "./_components/user-datatable";
   import useUsersQuery from "./_hooks/use-users-query";

   const UsersPage = () => {
     const users = useUsersQuery();

     return (
       <Page title="List User">
         <UserDatatable source={users.data} />
       </Page>
     );
   };

   export default UsersPage;
   ```

## How to set a permission for page

1. **Definisikan Permissions:**

      - Buat file `src/common/constants/permissions.ts` untuk mendefinisikan semua permission yang digunakan di aplikasi Anda.

   ```typescript
   // src/common/constants/permissions.ts
   export const PERMISSIONS = {
     user: {
       read: "user.read",
       write: "user.write",
     },
     // ...Definisikan permission lainnya...
   };
   ```

2. **Export Permissions di `page.tsx`:**
      - Di dalam file `page.tsx` dari module yang ingin Anda proteksi, export array `permissions` yang berisi permission yang dibutuhkan untuk mengakses page tersebut.

    ```typescript
    // src/app/(authenticated)/users/page.tsx
    import React from "react";
    import { PERMISSION } from "@/src/common/constants/permissions";

    export const permissions = [PERMISSION.user.read];

    const UsersPage = () => {
    return (
        <div>
        <h1>Users</h1>
        {/* ...Implementasi UI... */}
        </div>
    );
    };
    export default UsersPage;
    ```

## How to set a permission for section

1. **Gunakan Komponen `<Guard />`:**
      - Bungkus section dengan `<Guard permissions={[/* permissions */]} fallback={/* fallback UI */}>`.

    ```typescript
    import { Guard } from "@/app/_components/guard";
    import { PERMISSIONS } from "@/commons/constants/permissions";

    const MyComponent = () => (
    <div>
        <h1>My Component</h1>
        <Guard
        permissions={[PERMISSIONS.MY_SECTION.READ]}
        fallback={<p>No Access</p>}
        >
        {/* Protected Content */}
        </Guard>
    </div>
    );

    export default MyComponent;
    ```

1. **Contoh Penggunaan:**

    ```typescript
    {
    title: "NIK",
    render: (_, record) => (
    <Guard permissions={[PERMISSIONS.USER.READ]} fallback={record.employee?.emp_no}>
    <Link to={`/employee/${record.employee?.id}`}>{record.employee?.emp_no}</Link>
    </Guard>
    ),
    }
    ```

    Penjelasan: Komponen `<Guard />` menampilkan konten jika pengguna memiliki izin yang sesuai, jika tidak, ia menampilkan UI fallback.

## State Management

Pilih state management yang sesuai dengan kebutuhan kompleksitas aplikasi.

- **`useState`:**

  - **Kegunaan:** Untuk state lokal komponen yang sederhana dan jarang berubah.

- **`useContext`:**

  - **Kegunaan:** Untuk data global yang jarang berubah dan perlu diakses oleh banyak komponen (e.g., data user, theme)

- **`react-query`:**
  - **Kegunaan:** Untuk manajemen state yang berhubungan dengan data fetching dan caching.

## Admiral

See example component in [Link to admiral](https://beta--65cb2a66b1a56c748571f7ec.chromatic.com/?path=/docs/design-system-useravatar-default--docs)

---
