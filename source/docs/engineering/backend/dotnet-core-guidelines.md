---
title: Panduan .NET
description: Panduan .NET
extends: _layouts.documentation
section: content
---

# Panduan Pemrograman .NET
<!-- **Contributor**: Rizky Kurniawan | 
**Last Update**: 6 Mar 2025 -->

<hr>

# A). Development Environment

## System Requirements

Untuk memastikan keseragaman lingkungan pengembangan, setiap developer diharuskan menggunakan spesifikasi minimal berikut:

*   Operating System: Windows 10/11 atau macOS (Apple Silicon/Intel)
*   .NET SDK: Versi 8.0.x (sesuai dengan LTS)
*   Database Server: Microsoft SQL Server 2019 (Docker atau local installation)
*   Cache: Redis (Docker atau local installation)
*   Message Broker: NATS (Docker atau local installation)
*   Package Manager: `dotnet tool`, `NuGet`, dan `npm` (untuk frontend jika diperlukan)
*   Source Control: DOT GitLab Self-hosted ([https://gitlab.dot.co.id](https://gitlab.dot.co.id))

## Tools & IDE

Berikut daftar tools yang bisa digunakan oleh setiap developer:

*   IDE:
    *   Visual Studio Code (Disarankan)
    *   Visual Studio 2022 (Alternatif)
    *   JetBrains Rider (Alternatif)
*   Database Management:
    *   DBeaver (Disarankan)
    *   Azure Data Studio (Alternatif)
*   Redis Management:
    *   RedisInsight
*   NATS Management:
    *   NATS Nui
    *   CLI: `nats-server`, `nats`
*   Git Client:
    *   CLI atau GUI seperti Fork, GitKraken, atau SourceTree
*   API Testing:
    *   Apidog
    *   Postman

## Local Development Preparation

1. Instalasi Framework .NET 8.0

    ```bash
    dotnet --version
    ```

    Pastikan output menunjukkan versi Pastikan output menunjukkan versi `8.0.x`. Jika belum terinstal, download dari [Microsoft .NET](https://dotnet.microsoft.com/en-us/download).

2. Setup Database (MSSQL 2019) menggunakan Docker

    ```plain
    docker run -e 'ACCEPT_EULA=Y' -e 'SA_PASSWORD=YourPassword123!' -p 1433:1433 --name sqlserver -d mcr.microsoft.com/mssql/server:2019-latest
    ```

3. Setup Redis menggunakan Docker

    ```plain
    docker run --name redis -p 6379:6379 -d redis
    ```

4. Setup NATS menggunakan Docker

    ```plain
    docker run --name nats -p 4222:4222 -d nats
    ```

## Development Best Practices

*   Gunakan **Docker** untuk menjalankan service dependency agar konsisten.
*   Pastikan semua environment variable didefinisikan dalam `appsettings.Development.json`.
*   Pastikan semua service berjalan sebelum memulai development (`docker ps`).

<hr>

# B). Project Structure & Architecture

## Project Structure & Anatomy

Struktur base proyek .NET dirancang untuk memisahkan concern setiap komponen agar mudah dikelola, dikembangkan, dan di-scale. Mengikuti prinsip **Clean Architecture**, proyek dibagi menjadi beberapa layer dengan tanggung jawab masing-masing.

```plain
├── Commands
├── Constants
│   ├── Cache
│   ├── CircuitBreaker
│   ├── Event
│   ├── Logger
│   ├── Permission
│   └── Storage
├── Domain
│   ├── Auth
│   │   ├── Dtos
│   │   ├── Messages
│   │   ├── Repositories
│   │   ├── Services
│   │   ├── Token
│   │   └── Util
│   ├── File
│   │   ├── Dto
│   │   └── Services
│   ├── Logging
│   │   ├── Listeners
│   │   └── Services
│   ├── Notification
│   │   ├── Dtos
│   │   ├── Messages
│   │   ├── Repositories
│   │   └── Services
│   ├── Permission
│   │   ├── Dtos
│   │   ├── Messages
│   │   ├── Repositories
│   │   └── Services
│   ├── Role
│   │   ├── Dtos
│   │   ├── Messages
│   │   ├── Repositories
│   │   └── Services
│   └── User
│       ├── Dtos
│       ├── Messages
│       ├── Repositories
│       └── Services
├── Http
│   └── API
│       ├── Health
│       └── Version1
│           ├── Auth
│           │   └── Controllers
│           ├── EmailExample
│           │   └── Controllers
│           ├── File
│           │   └── Controllers
│           ├── Notification
│           ├── Permission
│           │   └── Controllers
│           ├── Role
│           │   └── Controllers
│           └── User
│               └── Controllers
├── Immutables
├── Infrastructure
│   ├── Attributes
│   ├── BackgroundHosted
│   ├── Databases
│   ├── Dtos
│   ├── Email
│   ├── Events
│   ├── Exceptions
│   ├── Filters
│   ├── Helpers
│   ├── Integrations
│   │   ├── Http
│   │   └── NATs
│   ├── Jobs
│   ├── Logging
│   ├── Middlewares
│   ├── ModelBinders
│   ├── Queues
│   ├── Regexs
│   ├── Repositories
│   ├── Seeders
│   ├── Shareds
│   └── Subscriptions
├── Log
├── Migrations
├── Models
├── Properties
├── SeedersData
├── Storage
├── bin
│   └── Debug
│       └── net8.0
│           ├── SeedersData
│           ├── cs
│           ├── de
│           ├── es
│           ├── fr
│           ├── it
│           ├── ja
│           ├── ko
│           ├── pl
│           ├── pt-BR
│           ├── ru
│           ├── runtimes
│           │   ├── unix
│           │   │   └── lib
│           │   │       ├── net6.0
│           │   │       ├── netcoreapp2.1
│           │   │       ├── netcoreapp3.0
│           │   │       └── netcoreapp3.1
│           │   ├── win
│           │   │   └── lib
│           │   │       ├── net6.0
│           │   │       ├── net8.0
│           │   │       ├── netcoreapp2.1
│           │   │       ├── netcoreapp3.0
│           │   │       ├── netcoreapp3.1
│           │   │       └── netstandard2.0
│           │   ├── win-arm
│           │   │   └── native
│           │   ├── win-arm64
│           │   │   └── native
│           │   ├── win-x64
│           │   │   └── native
│           │   └── win-x86
│           │       └── native
│           ├── tr
│           ├── zh-Hans
│           └── zh-Hant
├── copilot-prompts
├── dbdocs
├── deploy
│   └── ansible
└── obj
    └── Debug
        └── net8.0
            ├── ref
            ├── refint
            └── staticwebassets
```

Berikut adalah deskripsi dari masing-masing folder utama:

**Commands**

*   Berisi command handler untuk cli command.
*   Contoh: `CreateUserCommand.cs`, `UpdateUserCommand.cs`.

**Constants**

*   Menyimpan nilai-nilai konstan yang digunakan dalam aplikasi.
*   Subfolder:
    *   **Cache** → Key untuk Redis.
    *   **CircuitBreaker** → Konfigurasi untuk circuit breaker.
    *   **Event** → Nama event untuk messaging.
    *   **Logger** → Nama kategori log.
    *   **Permission** → Role-based permission.
    *   **Storage** → Path atau konfigurasi penyimpanan.

**Domain**

*   Layer domain berisi core business logic tanpa bergantung pada infrastruktur eksternal.
*   Dibagi berdasarkan **bounded context** seperti:
    *   **Auth**, **File**, **Logging**, **Notification**, **Permission**, **Role**, **User**.
*   Setiap submodul memiliki:
    *   **Dtos** → Data Transfer Objects.
    *   **Messages** → Event atau command message.
    *   **Repositories** → Interface untuk database access.
    *   **Services** → Business logic.
    *   **Token / Util** → Utility function.

**Http**

*   Berisi controller API dan dikelompokkan berdasarkan **versioning**.
*   Struktur:

```plain
pgsql
CopyEdit
/Http
  └── API
      ├── Health
      └── Version1
          ├── Auth
          │   └── Controllers
          ├── EmailExample
          │   └── Controllers
          ├── File
          │   └── Controllers
          ├── Notification
          ├── Permission
          │   └── Controllers
          ├── Role
          │   └── Controllers
          └── User
              └── Controllers
```

*   Setiap API memiliki controller dalam folder yang sesuai dengan domainnya.

**Immutables**

*   Berisi data yang bersifat immutable (tidak berubah), seperti konfigurasi statis atau daftar konstan yang digunakan di beberapa bagian aplikasi.

**Infrastructure**

*   Implementasi teknis yang mendukung aplikasi.
*   Subfolder:
    *   **Attributes** → Custom attributes untuk annotation.
    *   **BackgroundHosted** → Background service menggunakan `IHostedService`.
    *   **Databases** → Konfigurasi database dan migration.
    *   **Dtos** → DTO umum yang digunakan di seluruh infrastruktur.
    *   **Email** → Implementasi email sender.
    *   **Events** → Event handler.
    *   **Exceptions** → Custom exception.
    *   **Filters** → Action filter untuk middleware.
    *   **Helpers** → Utility/helper class.
    *   **Integrations**:
        *   **Http** → API client.
        *   **NATS** → Message broker client.
    *   **Jobs** → Scheduled background job.
    *   **Logging** → Logging provider.
    *   **Middlewares** → Middleware untuk request pipeline.
    *   **ModelBinders** → Custom model binding.
    *   **Queues** → Queue system untuk antrian proses.
    *   **Regexs** → Regular expressions.
    *   **Repositories** → Implementasi repository dari domain.
    *   **Seeders** → Data seeder untuk inisialisasi database.
    *   **Shareds** → Shared utility class.
    *   **Subscriptions** → Event subscription handler.

**Log**

*   Menyimpan log aplikasi, bisa berupa file atau konfigurasi logging.

**Migrations**

*   Menyimpan migration database Entity Framework Core.

**Models**

*   Model untuk Entity Framework Core.

**Properties**

*   Berisi konfigurasi proyek seperti `launchSettings.json` untuk debugging.

**SeedersData**

*   Dataset untuk seeding database.

**Storage**

*   Penyimpanan file (jika menggunakan sistem file lokal).

**bin / obj**

*   Hasil build dari proyek, tidak perlu di-tracking di Git.

**copilot-prompts**

*   Prompt atau script untuk AI Copilot.

**dbdocs**

*   Dokumentasi database (misal, menggunakan [dbdocs.io](http://dbdocs.io)).

**deploy**

*   Folder untuk konfigurasi deployment, misalnya:
    *   **Ansible** → Deployment automation script.

  

## Naming Convention

*   File Name

untuk file name menggunakan `PascalCase` contoh:

```plain
  UserController.cs
  UserService.cs
  UserModel.cs
  UserInterface.cs
```

*   Classes / Interface / Enum

untuk class / interface / enum / Constant menggunakan `PascalCase` contoh:

```cs
  public class UserController {}
  public enum UserRoleEnum {}
  public interface IUserService {}
```

*   Method and Variable

untuk function public gunakan `PascalCase` sedangkan untuk selain public bisa menggunakan `camelCase` dan diusahakan untuk descriptive contoh:

```cs
  public async Task<UserResponseDto> GetUserById(Guid id, bool isActive = true, bool throwExceptionIfNotFound = true) {}
```

untuk variable name gunakan `camelCase` dan diusahakan untuk descriptive contoh:

```cs
  var userActives = users.Select(x => x.isActive).ToList();
```

<hr>

# C). Logging & Monitoring

Logging & Monitoring sangat penting untuk memastikan aplikasi dapat dipantau dengan baik dan menangani error secara efektif. Berikut adalah struktur yang bisa digunakan:

## Best Practice

*   Gunakan **structured logging** agar log lebih mudah dianalisis.
*   Hindari logging data sensitif seperti **password, token, atau informasi pribadi**.
*   Gunakan **log level** dengan benar:
*   `Trace` → Debugging mendalam
*   `Debug` → Informasi debugging
*   `Information` → Event utama aplikasi (misalnya, user login)
*   `Warning` → Masalah potensial (misalnya, timeout request)
*   `Error` → Kesalahan yang perlu diperbaiki
*   `Critical` → Error kritis yang bisa menyebabkan downtime

  

Contoh

```cs
_logger.LogInformation("User {UserId} logged in at {Time}", userId, DateTime.UtcNow);
_logger.LogError(ex, "Failed to process request for {RequestId}", requestId);
```

## Error Monitoring

*   Gunakan middleware untuk menangkap semua unhandled exceptions secara global.
*   Pastikan error dicatat di sistem logging dan bisa dikirim ke monitoring tools seperti **Sentry, Application Insights, atau ELK Stack**.

## Security Concern

*   Jangan pernah logging **password, API keys, atau data sensitif lainnya**.
*   Jika menggunakan logging eksternal (seperti Sentry atau ELK), pastikan data yang dikirim sudah dianonimkan.
*   Gunakan **log retention policy** agar log tidak terus tumbuh tanpa batas dan membebani storage.

  

Hindari:

```cs
_logger.LogInformation("User logged in with password: {Password}", user.Password);
```

Sebagai gantinya, gunakan ID atau informasi anonim:

```plain
_logger.LogInformation("User {UserId} logged in successfully", user.Id);
```

<hr>

# D). Error Handling

## Best Practice

Error handling yang baik membantu mengurangi bug yang sulit dilacak dan memastikan aplikasi tetap berjalan dengan baik.

### **Menggunakan** **`try-catch`** **dengan Bijak**

*   Gunakan `try-catch` hanya pada operasi yang **rentan gagal**, seperti database query, HTTP request, atau file I/O.
*   Hindari `try-catch` berlebihan yang bisa menyembunyikan error atau membuat debugging lebih sulit.
*   Jangan tangkap `Exception` secara umum tanpa menangani error dengan benar.

  

**BAD PRACTICE (Menangkap semua exception tanpa logging)**

```cs
try
{
    var data = await _service.GetDataAsync();
}
catch (Exception)
{
    // Tidak melakukan apa-apa, sulit untuk debugging
}
```

**GOOD PRACTICE (Tangani exception dengan logging dan rethrow jika perlu)**

```cs
try
{
    var data = await _service.GetDataAsync();
}
catch (HttpRequestException ex)
{
    _logger.LogError(ex, "Error fetching data from external API.");
    throw new CustomApiException("Failed to fetch data", ex);
}
```

### **Membedakan Exception yang Dilempar (****`throw`****)**

*   Gunakan exception bawaan yang sesuai seperti `ArgumentException`, `InvalidOperationException`, dll.
*   Gunakan **custom exception** jika ada kasus spesifik dalam domain aplikasi.
*   Jangan tangkap dan rethrow `Exception` secara langsung tanpa menambahkan konteks.

  

**Contoh Custom Exception**

```cs
public class NotFoundException : Exception
{
    public NotFoundException(string message) : base(message) { }
}
```

**Penggunaan di Service Layer**

```cs
public async Task<User> GetUserByIdAsync(int id)
{
    var user = await _dbContext.Users.FindAsync(id);
    if (user == null)
    {
        throw new NotFoundException($"User with ID {id} not found.");
    }
    return user;
}
```

### **Global Exception Handling dengan Middleware**

*   Gunakan middleware untuk menangani error secara global, sehingga tidak perlu `try-catch` di setiap controller.
*   Pastikan response API tetap terstruktur dan user-friendly.

  

**Contoh global exception middleware**

```cs
public class ExceptionHandlingMiddleware
{
    private readonly RequestDelegate _next;
    private readonly ILogger<ExceptionHandlingMiddleware> _logger;

    public ExceptionHandlingMiddleware(RequestDelegate next, ILogger<ExceptionHandlingMiddleware> logger)
    {
        _next = next;
        _logger = logger;
    }

    public async Task Invoke(HttpContext context)
    {
        try
        {
            await _next(context);
        }
        catch (Exception ex)
        {
            _logger.LogError(ex, "Unhandled exception occurred.");
            context.Response.StatusCode = StatusCodes.Status500InternalServerError;
            await context.Response.WriteAsJsonAsync(new { Message = "An unexpected error occurred" });
        }
    }
}
```

Pada global exception middleware, response body dan status code juga dapat disesuaikan berdasarkan tipe exception yang terjadi, misalnya seperti berikut:

```cs
try
{
    await _next(context);
}
catch(Exeption ex)
{
    HttpStatusCode statusCode;
    string errorMessage;
  
    switch(error)
    {
        case DataNotFoundException:
            statusCode = HttpStatusCode.NotFound;
            errorMessage = "Data not found";
            break;
        case UnauthorizedAccessException:
            statusCode = HttpStatusCode.Unauthorized;
            errorMessage = "You are not allowed to access this resource";
            break;
        default:
            statusCode = HttpStatusCode.InternalServerError;
            errorMessage = ex.Message;
            _logger.LogError(ex, "Unhandled exception occurred.");
            break;
    }
    
    context.Response.StatusCode = statusCode;
    await context.Response.WriteAsJsonAsync(new { Message = errorMessage });    
}
```

  

## Rollback (Database & External Service Cleanup)

### **Database Transaction Rollback**

Jika terjadi error saat melakukan operasi database, pastikan transaksi dibatalkan untuk menghindari data yang tidak konsisten.

**Contoh menggunakan** **`DbContextTransaction`** **di Entity Framework Core:**

```cs
public async Task PlaceOrderAsync(Order order)
{
    using var transaction = await _dbContext.Database.BeginTransactionAsync();
    try
    {
        _dbContext.Orders.Add(order);
        await _dbContext.SaveChangesAsync();

        await _paymentService.ProcessPaymentAsync(order);

        await transaction.CommitAsync();
    }
    catch (Exception ex)
    {
        _logger.LogError(ex, "Error occurred while placing an order. Rolling back transaction.");
        await transaction.RollbackAsync();
        throw;
    }
}
```

### **Rollback Data di External Service (Misalnya, Microservice atau API Call)**

Jika aplikasi berinteraksi dengan layanan eksternal, perlu strategi untuk **rollback atau compensating action** jika terjadi kegagalan.

**Pendekatan yang bisa digunakan:**

1. **Soft Delete atau Status Update**
    *   Jika data sudah dibuat di layanan eksternal, tandai sebagai `CANCELLED` atau `FAILED` daripada menghapusnya.
2. **Compensating Transaction (Saga Pattern)**
    *   Untuk microservices, bisa gunakan **event-driven architecture** untuk membatalkan transaksi yang sudah berjalan.

**Contoh: Rollback Order jika pembayaran gagal**

```cs
public async Task PlaceOrderWithExternalPaymentAsync(Order order)
{
    using var transaction = await _dbContext.Database.BeginTransactionAsync();
    try
    {
        _dbContext.Orders.Add(order);
        await _dbContext.SaveChangesAsync();

        var paymentSuccess = await _paymentService.ProcessPaymentAsync(order);
        if (!paymentSuccess)
        {
            throw new PaymentFailedException("Payment failed.");
        }

        await transaction.CommitAsync();
    }
    catch (PaymentFailedException ex)
    {
        _logger.LogWarning("Payment failed, rolling back order.");
        await transaction.RollbackAsync();
        await _externalOrderService.CancelOrderAsync(order.Id); // Rollback external order
        throw;
    }
    catch (Exception ex)
    {
        _logger.LogError(ex, "Unexpected error while placing order.");
        await transaction.RollbackAsync();
        throw;
    }
}
```

<hr>

# E). Performance & Scalability

*   **Gunakan Asynchronous Programming (****`async/await`****)** untuk mencegah blocking yang bisa memperlambat aplikasi.
*   **Hindari Query Berulang ke Database** dalam loop, gunakan `Include()` atau `Batch Query`.
*   **Gunakan Caching** untuk mengurangi beban database atau API eksternal.
*   **Optimalkan I/O Bound Work** seperti file handling, database query, dan network request.
*   **Gunakan Connection Pooling** untuk meningkatkan efisiensi akses database dan service eksternal.
*   **Gunakan Streaming daripada Memuat Semua Data ke Memory** jika menangani data besar.

## 3rd Party Network Request

Ketika berinteraksi dengan API eksternal, optimasi perlu dilakukan untuk mengurangi latensi dan meningkatkan efisiensi.

### **Gunakan** **`HttpClient`** **dengan** **`HttpClientFactory`**

*   **Jangan buat** **`new HttpClient()`** **secara langsung** di setiap request, karena akan menyebabkan masalah koneksi (socket exhaustion).
*   **Gunakan** **`IHttpClientFactory`** untuk mengelola `HttpClient` dengan lebih baik.

  

**BAD PRACTICE (Membuat** **`HttpClient`** **secara langsung)**

```cs
public async Task<string> GetExternalDataAsync()
{
    using var client = new HttpClient();
    return await client.GetStringAsync("https://api.example.com/data");
}
```

**GOOD PRACTICE (Menggunakan** **`HttpClientFactory`****)**

```cs
public class ExternalService
{
    private readonly HttpClient _httpClient;

    public ExternalService(HttpClient httpClient)
    {
        _httpClient = httpClient;
    }

    public async Task<string> GetExternalDataAsync()
    {
        return await _httpClient.GetStringAsync("https://api.example.com/data");
    }
}
```

### **Batasi dan Optimalkan Request**

*   **Gunakan Retry & Circuit Breaker** dengan **Polly** untuk menangani request yang gagal.
*   **Gunakan Rate Limiting** agar tidak membebani API eksternal.

<hr>

# F). **Database & Query Optimization**

Database sering menjadi bottleneck dalam aplikasi, sehingga perlu dioptimalkan.

## Database Efficiency

### **Gunakan Indexing & Optimasi Query**

*   Pastikan tabel memiliki indeks pada kolom yang sering digunakan dalam `WHERE`, `JOIN`, dan `ORDER BY`.
*   Gunakan **`AsNoTracking()`** jika hanya membaca data tanpa perlu tracking perubahan.

  

**BAD PRACTICE (Query lambat dan tidak optimal)**

```cs
var users = await _dbContext.Users.Where(u => u.IsActive).ToListAsync();
```

**GOOD PRACTICE (Menggunakan** **`AsNoTracking()`** **dan Indexing)**

```cs
var users = await _dbContext.Users.AsNoTracking().Where(u => u.IsActive).ToListAsync();
```

### **Gunakan Bulk Insert dan Batch Update**

Jangan lakukan insert atau update dalam loop satu per satu, gunakan **EF Core Bulk Operations** atau **Batch Update**.

**BAD PRACTICE (Insert satu per satu, lambat untuk data besar)**

```plain
foreach (var user in users)
{
    _dbContext.Users.Add(user);
}
await _dbContext.SaveChangesAsync();
```

**GOOD PRACTICE (Gunakan Bulk Insert atau Batch Update)**

```cs
await _dbContext.Users.AddRangeAsync(users);
await _dbContext.SaveChangesAsync();
```

### **Connection Pooling untuk Database**

Gunakan connection pooling agar koneksi ke database lebih efisien dan tidak boros resource.

<!-- # Testing Strategy -->

<!-- # Deployment & CI/CD -->

<hr>

# G). Dependency Management

Dependency Management sangat penting untuk memastikan aplikasi tetap ringan, aman, dan mudah dikelola. Beberapa prinsip utama yang harus diikuti:

*   **Gunakan Dependency Injection (DI)** untuk menghindari tight coupling.
*   **Pilih library eksternal yang aktif dikembangkan dan memiliki dukungan komunitas.**
*   **Gunakan versi library yang stabil**, hindari menggunakan versi preview kecuali benar-benar diperlukan.
*   **Periksa lisensi library** sebelum digunakan di proyek komersial.
*   **Gunakan paket NuGet resmi dan hindari dependensi yang tidak diperlukan.**

## 3rd Party Library

.NET memiliki ekosistem NuGet yang luas. Berikut best practice untuk mengelola dependensi eksternal:

### **Gunakan** **`PackageReference`** **untuk Dependency Management**

*   `.csproj` harus menggunakan `PackageReference`, bukan `packages.config`.
*   Pastikan dependensi yang tidak digunakan dihapus dari proyek.

**Contoh dalam** **`.csproj`****:**

```xml
<ItemGroup>
    <PackageReference Include="Newtonsoft.Json" Version="13.0.3" />
    <PackageReference Include="Serilog" Version="3.0.1" />
</ItemGroup>
```

### Periksa semua dependensi yang digunakan dengan perintah:

```bash
dotnet list package
```

### **Hindari Menggunakan Versi yang Terlalu Spesifik**

*   Hindari menggunakan versi fixed (`Version="1.0.0"`), gunakan `>=` jika memungkinkan.
*   Misalnya, gunakan `Version="1.0.*"` agar kompatibel dengan minor updates.

### **Perbarui Dependensi secara Berkala**

Pastikan library selalu diperbarui untuk mendapatkan fitur terbaru dan patch keamanan.

*   **Periksa update dependensi:**

```bash
dotnet list package --outdated
```

*   **Perbarui semua package ke versi terbaru yang kompatibel:**

```bash
dotnet outdated --upgrade
```

<hr>

# H). Configuration Management

Configuration Management adalah aspek penting dalam pengembangan aplikasi .NET yang memastikan pengaturan sistem dapat dikelola dengan fleksibel, aman, dan mudah disesuaikan dengan berbagai environment (Development, Staging, Production). Dengan manajemen konfigurasi yang baik, aplikasi dapat dikonfigurasi tanpa perlu mengubah kode, mempermudah deployment, serta meningkatkan keamanan dengan menjaga informasi sensitif tetap terlindungi.

## **Struktur** **`appsettings.json`**

Contoh struktur appsettings.json yang baik:

```json
{
  "Logging": {
    "LogLevel": {
      "Default": "Information",
      "Microsoft": "Warning",
      "System": "Error"
    }
  },
  "ConnectionStrings": {
    "DefaultConnection": "Server=myserver;Database=mydb;User Id=myuser;Password=mypassword;"
  },
  "Redis": {
    "Host": "localhost",
    "Port": 6379
  },
  "ExternalService": {
    "BaseUrl": "https://api.example.com",
    "ApiKey": "your-api-key"
  }
}
```

## **Menggunakan Environment-Specific Configuration**

.NET secara otomatis membaca file konfigurasi berdasarkan environment.

1. Tambahkan `appsettings.{ENVIRONMENT}.json`
    *   `appsettings.Development.json`
    *   `appsettings.Production.json`
2. Pastikan file tambahan dimuat di `Program.cs`

  

```cs
var builder = WebApplication.CreateBuilder(args);
builder.Configuration
    .SetBasePath(Directory.GetCurrentDirectory())
    .AddJsonFile("appsettings.json", optional: false, reloadOnChange: true)
    .AddJsonFile($"appsettings.{builder.Environment.EnvironmentName}.json", optional: true)
    .AddEnvironmentVariables();
```

## **Membaca Konfigurasi Menggunakan** **`IConfiguration`**

Untuk membaca konfigurasi langsung dari `appsettings.json`:

```cs
public class MyService
{
    private readonly IConfiguration _configuration;

    public MyService(IConfiguration configuration)
    {
        _configuration = configuration;
    }

    public string GetApiUrl()
    {
        return _configuration["ExternalService:BaseUrl"];
        // atau
        return _configuration.GetValue<string>("ExternalService:BaseUrl");
    }
}
```
