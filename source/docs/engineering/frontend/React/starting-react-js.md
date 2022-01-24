# Code in React


Skeleton
- simple structure react simple app
- more advanced structure
- more advanced structure again

## Membuat Component
Dalam pembuatan aplikasi menggunakan react hal yang sering dijumpai adalah component. Component ini bisa terdiri dari berbagai level kompleksitas dan peran. Terdapat component sebagai wrapper/layout, component untuk primitive ui, component yang digunakan di level domain (component memiliki logic business). Jika mengikuti konsep atomic design, component juga bisa terdiri dari beberapa level, yakni atomic, molekul, organism, template, pages. Perlu kita ketahui bahwa component ini bertujuan untuk membantu kita untuk membuat aplikasi lebih mudah dari segi readability dan maintainability. 

## Naming Standard
Menggunakan `PascalCase`
example:
- ButtonBase
- ButtonGroup
- RadioButtonGroup
- Card
- PaginationButton
- Pagination

Common things in React Project
- Component
    - Layout
        - Next js Persist page state (prevent rerendering)
    - Shared Component / Base Component
    - Spesific Component (Domain Based / Spesific Page usage)
    - Component as Wrapper
    - Structuring a Component
        - Defining API for Component / exposing props
        - Maintanable Component
    - Testing Component
- Infrastructure / Helper
    - Http Client
    - Persistance Storage
    - 
- Hook
    - Shared Hook /Helper Hook
    - Domain spesific Hook / Business Handler Hook
- Form
    - Form Submission
    - Validation
        - yup

