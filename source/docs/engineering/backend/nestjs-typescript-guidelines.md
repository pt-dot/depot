---
title: Panduan Nest JS Typescript
description: Panduan Nest JS Typescript
extends: _layouts.documentation
section: content
---

# Panduan Pemrograman Nest JS Typescript
<!-- **Contributor**: Akhmad Khasan Abdullah | 
**Last Update**: 6 Mar 2025 -->

<hr>

# A). Development Environment Setup

## System Requirements

Untuk memastikan lingkungan pengembangan yang konsisten, ikuti langkap-langkah berikut ini:

* Operating System: Windows 10/11 atau macOS (Apple Silicon/Intel)
* Node.js: Versi 20.* (Gunakan versi LTS)
* Database Server: PostgreSQL atau MySQL (Docker atau local installation)
* Cache: Redis (Docker atau local installation)
* Package Manager: `yarn` / `pnpm` / `npm`
* Source Control: DOT GitLab Self-hosted ([https://gitlab.dot.co.id](https://gitlab.dot.co.id))

## Tools & IDE

Berikut daftar tools yang bisa digunakan oleh setiap developer:

* IDE: 
  * Visual Studio Code (Disarankan)
  * JetBrains WebStorm (Alternatif)
* Database Management GUI:
  * DBeaver (Disarankan)
* Redis Management:
  * RedisInsight
* Git Client:
  * CLI atau GUI seperti Fork, GitKraken, atau SourceTree
* API Testing:
  * Apidog (Disarankan)
  * Postman

## Local Development Preparation

1. Instalasi Node.js (Menggunakan NVM)

  Petunjuk instalasi bisa diakses [disini](https://www.freecodecamp.org/news/node-version-manager-nvm-install-guide/)

  ```bash
  nvm install --lts
  nvm use --lts
  ```

2. Setup Database menggunakan Docker

  PostgreSQL

  ```bash
  docker run --name Postgres -e POSTGRES_PASSWORD=YourPassword! -d -p 0.0.0.0:5432:5432 -v postgres_data:/var/lib/postgresql/data postgres
  ```

  MySQL

  ```bash
  docker run --name='MySQL' -d -p 0.0.0.0:3306:3306 mysql/mysql-server:8.0.28
  ```

3. Setup Redis menggunakan Docker

  ```bash
  docker run --name redis -p 6379:6379 -d redis
  ```

## Development Best Practices

* Gunakan Docker untuk menjalankan service dependency agar konsisten.
* Pastikan semua environment variable didefinisikan dalam appsettings.Development.json.
* Pastikan semua service berjalan sebelum memulai development (docker ps).


<!-- 1. Install Node.js: Gunakan versi LTS terbaru. Disarankan menggunakan NVM (Node Version Manager) untuk mengelola berbagai versi Node.js.

```plain
nvm install --lts
nvm use --lts
```

2. Pilih Teks Editor: Rekomendasi **Visual Studio Code (VS Code)** dengan ekstensi berikut:
    *   ESLint
    *   Prettier
    *   NestJS Snippets
    *   GitLens
3. Install Git: Pastikan Git terinstall dan dikonfigurasi dengan benar.

```verilog
git config --global user.name "Nama Anda"
git config --global user.email "email@example.com"
``` -->

<hr>

# B). Project Structure & Anatomy

Struktur base proyek dirancang untuk memisahkan concern setiap komponen agar mudah dikelola, dikembangkan, dan di-scale. Mengikuti prinsip **Clean Architecture**, proyek dibagi menjadi beberapa layer dengan tanggung jawab masing-masing.

```plain
├── api
│   ├── assets
│   ├── dist
│   ├── src
│   │   ├── cache
│   │   ├── common
│   │   │   ├── constants
│   │   │   ├── enums
│   │   │   ├── filters
│   │   │   ├── interceptors
│   │   │   ├── interface
│   │   │   ├── pipes
│   │   │   ├── request
│   │   │   ├── rules
│   │   │   └── utils
│   │   ├── health
│   │   ├── infrastructure
│   │   │   ├── applications
│   │   │   ├── cache
│   │   │   │   ├── decorators
│   │   │   │   ├── interceptors
│   │   │   │   ├── middlewares
│   │   │   │   └── services
│   │   │   ├── error
│   │   │   ├── mail
│   │   │   │   └── templates
│   │   │   ├── notification
│   │   │   │   └── services
│   │   │   └── schedules
│   │   └── modules
│   │       ├── auth
│   │       │   ├── applications
│   │       │   ├── controllers
│   │       │   │   └── v1
│   │       │   ├── dto
│   │       │   ├── guards
│   │       │   ├── responses
│   │       │   ├── serializers
│   │       │   ├── services
│   │       │   └── strategies
│   │       ├── common
│   │       │   ├── applications
│   │       │   ├── controllers
│   │       │   │   └── v1
│   │       │   ├── dto
│   │       │   └── services
│   │       ├── queue
│   │       │   ├── contants
│   │       │   ├── contracts
│   │       │   └── services
│   │       └── user
│   │           ├── applications
│   │           ├── controllers
│   │           │   └── v1
│   │           ├── request
│   │           ├── responses
│   │           └── services
│   └── storages
├── backoffice
│   ├── @contracts
│   │   └── auth
│   │        ├── request
│   │        └── schema
│   ├── app
│   │   ├── Components
│   │   │   ├── atoms
│   │   │   │   └── Button
│   │   │   ├── molecules
│   │   │   │   ├── Breadcrumbs
│   │   │   │   ├── DescriptionContainer
│   │   │   │   ├── Dropdowns
│   │   │   │   ├── Form
│   │   │   │   ├── Headers
│   │   │   │   ├── Pickers
│   │   │   │   ├── Progress
│   │   │   │   ├── RowActionButtons
│   │   │   │   ├── Section
│   │   │   │   └── TimelinesItem
│   │   │   └── organisms
│   │   │       ├── DataTable
│   │   │       ├── FilterSection
│   │   │       │   └── InputCollection
│   │   │       └── FormContainer
│   │   ├── Contexts
│   │   ├── Enums
│   │   ├── Layouts
│   │   │   ├── Login
│   │   │   └── MainLayout
│   │   ├── Modules
│   │   │   ├── Auth
│   │   │   │   ├── ForgotPassword
│   │   │   │   └── Login
│   │   │   ├── Common
│   │   │   ├── Inertia
│   │   │   ├── Notification
│   │   │   ├── Page
│   │   │   ├── Profile
│   │   │   └── User
│   │   ├── Pages
│   │   │   ├── Configs
│   │   │   ├── Iam
│   │   │   │   ├── Permissions
│   │   │   │   ├── RolePermissions
│   │   │   │   ├── Roles
│   │   │   │   └── Users
│   │   │   ├── LogActivities
│   │   │   ├── Notifications
│   │   │   ├── Profile
│   │   │   └── Sample
│   │   │       ├── Detail
│   │   │       └── Form
│   │   ├── Types
│   │   └── Utils
│   ├── assets
│   ├── public
│   │   ├── css
│   │   ├── img
│   │   ├── js
│   │   ├── lib
│   │   │   ├── bootstrap
│   │   │   │   └── dist
│   │   │   │       ├── css
│   │   │   │       └── js
│   │   │   ├── jquery
│   │   │   │   └── dist
│   │   │   ├── jquery-validation
│   │   │   │   └── dist
│   │   │   └── jquery-validation-unobtrusive
│   │   ├── temp
│   │   └── unity
│   │       ├── css
│   │       ├── img
│   │       └── js
│   │           └── lib
│   ├── src
│   │   ├── common
│   │   │   ├── enums
│   │   │   ├── filters
│   │   │   ├── interceptors
│   │   │   ├── interface
│   │   │   ├── pipes
│   │   │   ├── request
│   │   │   ├── rules
│   │   │   └── utils
│   │   ├── infrastructure
│   │   │   ├── ability
│   │   │   ├── applications
│   │   │   ├── cache
│   │   │   │   ├── decorators
│   │   │   │   ├── middlewares
│   │   │   │   └── services
│   │   │   ├── entities
│   │   │   │   └── subscribers
│   │   │   ├── error
│   │   │   ├── event
│   │   │   ├── inertia
│   │   │   │   ├── adapter
│   │   │   │   ├── entities
│   │   │   │   └── middlewares
│   │   │   ├── mail
│   │   │   │   └── templates
│   │   │   ├── notification
│   │   │   │   └── services
│   │   │   ├── redis
│   │   │   ├── sentry
│   │   │   └── serializers
│   │   └── modules
│   │       ├── auth
│   │       │   ├── applications
│   │       │   ├── controllers
│   │       │   ├── guards
│   │       │   ├── requests
│   │       │   ├── responses
│   │       │   ├── serializers
│   │       │   ├── services
│   │       │   └── strategies
│   │       ├── common
│   │       │   └── controllers
│   │       ├── config
│   │       │   ├── applications
│   │       │   ├── controllers
│   │       │   ├── guards
│   │       │   ├── mappers
│   │       │   ├── requests
│   │       │   ├── responses
│   │       │   └── services
│   │       ├── glob
│   │       │   └── service
│   │       ├── iam
│   │       │   ├── applications
│   │       │   ├── controllers
│   │       │   ├── decorators
│   │       │   ├── guards
│   │       │   ├── mappers
│   │       │   ├── middlewares
│   │       │   ├── policies
│   │       │   ├── requests
│   │       │   ├── responses
│   │       │   └── services
│   │       ├── log-activity
│   │       │   ├── applications
│   │       │   ├── controllers
│   │       │   ├── requests
│   │       │   ├── responses
│   │       │   └── services
│   │       ├── main
│   │       │   └── controllers
│   │       ├── notification
│   │       │   ├── applications
│   │       │   ├── controllers
│   │       │   ├── middlewares
│   │       │   ├── requests
│   │       │   └── services
│   │       ├── profile
│   │       │   ├── applications
│   │       │   ├── controllers
│   │       │   ├── requests
│   │       │   ├── responses
│   │       │   └── services
│   │       └── queue
│   │           ├── contants
│   │           ├── contracts
│   │           └── services
│   └── storages
└── graphql
    ├── assets
    ├── public
    └── src
        ├── common
        │   ├── enums
        │   ├── filters
        │   ├── guards
        │   ├── interface
        │   ├── middlewares
        │   ├── request
        │   └── utils
        ├── infrastructure
        │   ├── applications
        │   └── cache
        │       ├── decorators
        │       ├── middlewares
        │       └── services
        └── modules
            ├── auth
            │   ├── applications
            │   ├── resolvers
            │   ├── services
            │   └── types
            └── iam
                ├── applications
                ├── mutations
                ├── resolvers
                ├── services
                └── types
```

<hr>

# C). Code Style and Principle

## **Naming Convention**

### File Name
*   Use `kebab-case` for file name
*   Include the file type in the name

```plain
user.controller.ts
user.service.ts
user.entity.ts
user.interface.ts
```

```plain
export class UserController {}
export class UserService {}
export class CreateUserDto {}

export interface IUser
```

```cs
async findUserById(userId: string): Promise<User> {}
const userPassword: string;
```

## **Code Concistency**

### Using Enum

Gunakan **Enum** untuk mendefinisikan nilai tetap yang memiliki keterkaitan, seperti status pengguna atau role.

❌ Bad: (Menggunakan string hardcode untuk role secara langsung)

```plain
export class User {
  id: number;
  name: string;
  role: string; // Tidak disarankan
}

// Contoh penggunaan
const user: User = { id: 1, name: 'John', role: 'admin' }; // Rentan typo
console.log(user.role); // Output: 'admin'
```

✅ Good: (Menggunakan `enum`)

```typescript
export enum UserRole {
  ADMIN = 'admin',
  USER = 'user',
  MODERATOR = 'moderator',
}

export class User {
  id: number;
  name: string;
  role: UserRole;
}

// Contoh penggunaan
const user: User = { id: 1, name: 'John', role: UserRole.ADMIN };
console.log(user.role); // Output: 'admin'
```

### Using Constant

* Gunakan **constant (`const`)** untuk nilai tetap yang tidak berubah.
❌ Bad: (Menggunakan magic number atau string langsung)

```typescript
export class AuthService {
  loginAttempts: number = 0;

  login() {
    if (this.loginAttempts >= 5) { // Magic number, sulit diubah
      throw new Error('Too many login attempts');
    }
    this.loginAttempts++;
  }
}
```

```typescript
// application.constant.ts
export const MAX_LOGIN_ATTEMPTS = 5;

// auth.service.ts
export class AuthService {
  loginAttempts: number = 0;

  login() {
    if (this.loginAttempts >= MAX_LOGIN_ATTEMPTS) {
      throw new Error('Too many login attempts');
    }
    this.loginAttempts++;
  }
}
```

```python
export class UserService {
  getUserById(id: number): any {
    return { id, name: 'John Doe', role: 'user' };
  }
}
```

```typescript
export class UserService {
  getUserById(id: number): Promise<User | null> {
    return new Promise((resolve) => {
      resolve({ id, name: 'John Doe', role: UserRole.USER });
    });
  }
}
```

## **Clean / Layering Pattern Principle**
* Presentation Layer (Controller)
* Presentation Layer atau Controller memiliki responsibility untuk melakukan handle request dan response atas client.

```less
@Controller('users')
export class UserController {
  constructor(private readonly userService: UserService) {}

  @Post()
  async createUser(@Body() dto: CreateUserDto) {
    return this.userService.createUser(dto);
  }
}
```

```typescript
@Injectable()
export class UserService {
  constructor(private readonly userRepository: UserRepository) {}

  async createUser(dto: CreateUserDto) {
    const user = await this.userRepository.create(dto);
    return user;
  }
}
```

```less
@Injectable()
export class UserRepository {
  constructor(
    @InjectRepository(UserEntity)
    private readonly repository: Repository<UserEntity>,
  ) {}

  async create(dto: CreateUserDto): Promise<UserEntity> {
    return this.repository.save(dto);
  }
}
```

<hr>

# D). Database & Query Effeciency

* Menggunakan TypeORM sebagai database ORM [\[Link\]](https://docs.nestjs.com/recipes/sql-typeorm)
* Pastikan setiap query optimal dengan memanfaatkan indexing pada kolom yang sering dicari

❌ Bad: (Tidak menggunakan indexing pada column)

```less
@Entity()
export class User {
  @PrimaryGeneratedColumn()
  id: number;

  @Column({ unique: true })
  email: string;
  
  @Column()
  name: string;
}
```

✅ Good: (Menggunakan indexing pada column)

```less
@Entity()
@Index(['email', 'name']) // Menambahkan index pada column
export class User {
  @PrimaryGeneratedColumn()
  id: number;

  @Column({ unique: true })
  email: string;
  
  @Column()
  name: string;
}
```

* Gunakan **pagination** dengan `take` dan `skip` ketika melakukan get all data, agar tidak membebani database

❌ Bad: (Tidak menggunakan pagination untuk data yang besar)

```cs
const notifications = await this.notificationRepository.find();
```

✅ Good: (Menggunakan pagination untuk data yang besar)

```cs
const notifications = await this.notificationRepository.find({
	take: 10,
	skip: 20
});
```

* Gunakan DB Transaction jika ada proses yang melakukan operasi CREATE / UPDATE / DELETE pada multi-table [\[Link\]](https://orkhan.gitbook.io/typeorm/docs/transactions)

❌ Bad: (Melakukan query satu per satu tanpa transaction, rawan terjadi inkonsistensi data jika salah satu terjadi error)

```kotlin
const order = this.orderRepository.create({ userId, totalPrice: 100 });
await this.orderRepository.save(order);

const payment = this.paymentRepository.create({ orderId: order.id, status: 'pending' });
await this.paymentRepository.save(payment);
```

✅ Good: (Menggunakan transaction pada operasi multi-table)

```dart
await this.dataSource.transaction(async (manager) => {
  const order = manager.create(Order, { userId, totalPrice: 100 });
  await manager.save(order);

  const payment = manager.create(Payment, { orderId: order.id, status: 'pending' });
  await manager.save(payment);
});
```

* Hindari melakukan select semua field / column, selalu tentukan field yang akan diperlukan

❌ Bad: (Mengambil semua kolom, membebani database)

```cs
const user = await this.userRepository.findOne({
  where: { id },
});
```

✅ Good: (Mengambil hanya kolom yang dibutuhkan)

```cs
const user = await this.userRepository
  .createQueryBuilder('user')
  .select(['user.id', 'user.name', 'user.email'])
  .where('user.id = :id', { id })
  .getOne();
```

<hr>

# E). Error Handling & Logging

* Implementasikan **Global Exception Filter** untuk menangani error secara global [\[Link\]](https://docs.nestjs.com/exception-filters)

```php
import { ExceptionFilter, Catch, ArgumentsHost, HttpException } from '@nestjs/common';
@Catch(HttpException)
export class HttpErrorFilter implements ExceptionFilter {
  catch(exception: HttpException, host: ArgumentsHost) {
    // Custom your exception handling logic here
  }
}
```

* Implementasikan **Custom Exception** jika ada kebutuhan exception yang spesifik [\[Link\]](https://docs.nestjs.com/exception-filters#custom-exceptions)

```javascript
// otp-invalid.exception.ts
export class OtpInvalidException extends HttpException {
	constructor(
		super('Invalid OTP', HttpStatus.BAD_REQUEST)
	) {}
}

// auth-otp.service.ts
export class AuthOtpService {
	constructor() {}
	
	async validateOtp(otpRequest: OtpRequestDto) {
		const isValid = true;
		if (!isValid) {
			throw new OtpInvalidException();
		}
	}
}
```

* Implementasikan Logging untuk proses yang memerlukan monitoring state (ex: sync data, background proses, etc) [\[Link\]](https://docs.nestjs.com/techniques/logger)

```typescript
import { Injectable } from '@nestjs/common';
import { Cron } from '@nestjs/schedule';
import { AppLogger } from '../logger/logger.service';

@Injectable()
export class SyncService {
	private readonly logger = new Logger(SyncService.name);

  @Cron('0 * * * *') // Jalankan setiap jam
  async syncData(): Promise<void> {
    this.logger.log('Memulai sinkronisasi data dari background process...');

    try {
      // Simulasi proses sinkronisasi
      await new Promise((resolve) => setTimeout(resolve, 3000));

      this.logger.log('Data berhasil disinkronisasi dari background process.');
    } catch (error) {
      this.logger.error('Error saat sinkronisasi data', error.stack);
    }
  }
}
```

<hr>

# F). Security

* Gunakan `min` dan `max` (opsional) untuk data payload dengan type `number` pada DTO

❌ Bad:

```scala
const TopupSaldoSchema = z.object({ 
	amount: z.number(), // Tidak menggunakan min value
})

export class TopupSaldoDto extends createZodDto(TopupSaldoSchema) {}
```

✅ Good:

```scala
import { z } from 'zod';
import { createZodDto } from 'nestjs-zod'

const TopupSaldoSchema = z.object({ 
	amount: z.number().min(10_000), // Menggunakan min value untuk menghindari nilai negatif
})

export class TopupSaldoDto extends createZodDto(TopupSaldoSchema) {}
```

* Gunakan `@IsUUID()` untuk data payload dengan type `string` yang ekspektasinya akan menerima nilai UUID pada DTO

❌ Bad:

```scala
import { z } from 'zod';
import { createZodDto } from 'nestjs-zod'

const GetUserSchema = z.object({ 
	userId: z.string(), // Tidak menggunakan type uuid
})

export class GetUserDto extends createZodDto(GetUserSchema) {}
```

✅ Good:

```scala
import { z } from 'zod';
import { createZodDto } from 'nestjs-zod'

const GetUserSchema = z.object({ 
	userId: z.string().uuid("Format tidak valid"), // Tidak menggunakan type uuid
})

export class GetUserDto extends createZodDto(GetUserSchema) {}
```

* Gunakan nilai `@MinLength()` dan `@MaxLength()` untuk melakukan validasi atas data payload dengan type `string` . Gunakan nilai `@MaxLength()` sesuai nilai byte database untuk column `text`

❌ Bad:

```scala
import { z } from 'zod';
import { createZodDto } from 'nestjs-zod'

export const RegisterUserSchema = z.object({
  password: z.string()
    .min(8, "Password minimal 8 karakter")
    .max(32, "Password maksimal 32 karakter"),
  
  description: z.string()
    .max(255, "Deskripsi maksimal 255 karakter"),
});

export class RegisterUserDto extends createZodDto(RegisterUserSchema) {}
```

✅ Good:

```scala
import { z } from 'zod';
import { createZodDto } from 'nestjs-zod'

export const RegisterUserSchema = z.object({
  password: z.string()
    .min(8, "Password minimal 8 karakter")
    .max(32, "Password maksimal 32 karakter"),
  
  description: z.string()
    .max(255, "Deskripsi maksimal 255 karakter"),
});

export class RegisterUserDto extends createZodDto(RegisterUserSchema) {}
```

* Tidak meletakkan endpoint atau informasi credential yang bersifat private secara hard code di dalam source code.

❌ Bad:

```typescript
export class SendDataToExternal {
	private secretKey = 'ThisIsN0tSuppOs3dToBeHere';
	private prodUrl = 'https://someprivateip/api';
	
	async sendData() {
		// logic
	}
}
```

✅ Good:

```typescript
// .env
SECRET_KEY="ThisIsSuppOs3dToBeHere"
PROD_URL="https://someprivateip/api"

// config.ts
import * as dotenv from 'dotenv';
dotenv.config();

export const config = {
	secretKey: process.env.SECRET_KEY || '',
	prodUrl: process.env.PROD_URL || ''
};

// send-data-to-external.service.ts
export class SendDataToExternal {
	private secretKey = 'ThisIsN0tSuppOs3dToBeHere';
	private prodUrl = 'https://someprivateip/api';
	
	async sendData() {
		// logic
	}
}
```

<hr>

# G). Configuration

* Semua konfigurasi yang sifatnya rahasia harus diset melalui file `config.ts` yang nilai nya diambil dari file `.env`

❌ Bad:

```dart
// config.ts (BAD)
export const config = {
  dbHost: 'localhost',
  dbUser: 'admin',
  dbPassword: 'secret123', // Informasi sensitif langsung di-hardcode
  dbName: 'mydb',
};
```

✅ Good:

```javascript
// .env
DB_HOST=localhost
DB_USER=admin
DB_PASSWORD=secret123
DB_NAME=mydb

// config.ts
import * as dotenv from 'dotenv';
dotenv.config();

export const config = {
  dbHost: process.env.DB_HOST || '',
  dbUser: process.env.DB_USER || '',
  dbPassword: process.env.DB_PASSWORD || '',
  dbName: process.env.DB_NAME || '',
};
```

* Grouping `.env` sesuai dengan kegunaannya dan gunakan prefix yang sama

❌ Bad:

```plain
KEY=abc123
SECRET=secret456
HOST=localhost
USER=admin
PASSWORD=secret123
NAME=mydb
```

✅ Good:

```plain
# Database Configuration
DB_HOST=localhost
DB_USER=admin
DB_PASSWORD=secret123
DB_NAME=mydb

# API Configuration
API_KEY=abc123
API_SECRET=secret456
```
