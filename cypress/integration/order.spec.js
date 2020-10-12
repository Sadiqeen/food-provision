import faker from 'faker'

describe('Brand module', () => {

    const vessel_name = faker.name.findName()
    const product_select = "Acacia"
    const po = faker.random.uuid()

    before(() => {
        cy.clearCookies()
        cy.visit('/')

        cy.get('input[name="email"]').clear()
        cy.get('input[name="email"]').type('admin@admin.com')
        cy.get('input[name="password"]').clear()
        cy.get('input[name="password"]').type('password')
        cy.get('button[type="submit"]').click()
        cy.url().should('include', '/dashboard')
    })

    beforeEach(() => {
        Cypress.Cookies.preserveOnce('food_provision_system_session', 'XSRF-TOKEN')
    })

    it('Add order', () => {
        cy.visit('admin/order')
        cy.contains('Create Order').click()
        cy.get('#dataTable_filter > label > .form-control').type(product_select)
        cy.wait(2000)
        cy.get('.input-group > .form-control').clear()
        cy.get('.input-group > .form-control').type(10)
        cy.contains('Add Order').click()
        cy.wait(2000)
        cy.get('#total').should((r) => {
            return r.text() > 0
        })
        cy.contains('Confirm Order').click()
        cy.url().should('include', 'admin/order/confirm')
        cy.get('#vessel_name').type(vessel_name)
        cy.get('.btn-primary').click()
        cy.url().should('include', 'admin/order')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type(vessel_name)
        cy.wait(2000)
        cy.contains(vessel_name).click()
    })

    it('Save purchase order', () => {

        cy.visit('admin/order')

        cy.get('#dataTable_filter > label > .form-control').type(vessel_name)
        cy.wait(2000)
        cy.get(':nth-child(2) > .btn-primary').click()
        cy.get('#po').type(po)
        cy.get('.text-center > .btn').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type(vessel_name)
        cy.wait(2000)
        cy.contains('Confirmed order')
    })

    it('Update order status', () => {

        cy.visit('admin/order')

        cy.get('#dataTable_filter > label > .form-control').type(vessel_name)
        cy.wait(2000)
        cy.get(':nth-child(2) > .btn-primary').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type(vessel_name)
        cy.wait(2000)
        cy.contains('Order in process')
        cy.get(':nth-child(2) > .btn-primary').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type(vessel_name)
        cy.wait(2000)
        cy.contains('Shipping')
        cy.get(':nth-child(2) > .btn-primary').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type(vessel_name)
        cy.wait(2000)
        cy.contains('Delivery confirmed')
        cy.get(':nth-child(2) > .btn-primary').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type(vessel_name)
        cy.wait(2000)
        cy.contains('No matching records found')
    })

    it('Check order history', () => {
        cy.visit('admin/report')
        cy.get('#dataTable_filter > label > .form-control').type(vessel_name)
        cy.contains('Order completed')
    })
})
