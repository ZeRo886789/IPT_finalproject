# Final Capstone Scope — Tailoring Shop Management System

## Source brief extracted from supplied reference
The provided reference identifies:
1. Tailoring Shop Management System
2. Customers
3. Employees
4. Clothing Orders
5. Measurements
6. Payments

## Rework mapping

| Original starter | Final system |
|---|---|
| Coaches | Employees |
| Teams | Customers |
| Players | Clothing Orders |
| Games | Measurements |
| Scores | Payments |

The original basketball-specific controllers, models, migrations, seeders, navigation and pages were removed/replaced. The Laravel application now uses tailoring-specific terminology, data relationships, validation and UI.

## CRUD coverage

Each required management entity has:
- index/list page
- search/filter where useful
- create page
- store action
- detail/show page
- edit page
- update action
- delete action
- validation
- relationship-aware data

## Relationship design

- Customer has many Clothing Orders
- Customer has many Measurements
- Employee has many Clothing Orders
- Clothing Order belongs to Customer
- Clothing Order optionally belongs to Employee
- Clothing Order has many Measurements
- Clothing Order has many Payments
- Measurement belongs to Customer
- Measurement optionally belongs to Clothing Order
- Payment belongs to Clothing Order

## Business workflow

Customer → Clothing Order → Measurement → Production/Status → Payment → Completion

The dashboard summarizes this workflow and provides quick access to create a new order or record a payment.

## Uploading / GitHub

No push or upload automation is included. The project is intentionally prepared for the student to initialize/configure and push manually.
