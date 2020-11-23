import faker from 'faker'

describe('Brand module', () => {

    const brand =  faker.lorem.word()
    const brand_update =  faker.lorem.word()

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
        Cypress.Cookies.preserveOnce('food_provision_application_session', 'XSRF-TOKEN')
    })

    it('switch language', () => {
        cy.contains('English').click()
        cy.contains('System')
    })

    it('Add brand', () => {
        cy.visit('admin/brand')
        cy.get('#brand').type(brand)
        cy.get('[data-cy=create]').click()
        cy.contains('Success')
    })

    it('Add brand [unique value check]', () => {
        cy.visit('admin/brand')
        cy.get('#brand').type(brand)
        cy.get('[data-cy=create]').click()
        cy.contains('The brand has already been taken.')
    })

    it('Update brand', () => {
        cy.visit('admin/brand')
        cy.wait(500)
        cy.get('#dataTable_filter > label > .form-control').type(brand)
        cy.wait(1000)
        cy.get('.text-warning-dark > .fa-pencil').click()
        cy.get('#brand_edit').clear()
        cy.get('#brand_edit').type(brand_update)
        cy.get('[data-cy=update]').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type(brand)
        cy.wait(1000)
        cy.contains(/No matching records found|No data available in table/g)
    })

    it('Delete brand', () => {
        cy.get('#dataTable_filter > label > .form-control').clear()
        cy.get('#dataTable_filter > label > .form-control').type(brand_update)
        cy.wait(1000)
        cy.get('.text-danger > .fa').click()
        cy.get('.swal2-confirm').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type(brand_update)
        cy.wait(1000)
        cy.contains(/No matching records found|No data available in table/g)
    })

})
