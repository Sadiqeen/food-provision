describe('Product module', () => {
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

    it('switch language', () => {
        cy.contains('English').click()
        cy.contains('System')
    })

    it('Add product', () => {
        cy.visit('admin/product')
        cy.contains('Add Product').click()
        cy.get('#name_en').type('Test Product')
        cy.get('#name_th').type('ทดสอบ')
        cy.get('#price').type('250')
        cy.get('#description').type('2x2.5 kg')
        cy.get('#vat').check()
        cy.get('.btn-success').click()
        cy.contains('Success')
    })

    it('Add product [unique value check]', () => {
        cy.visit('admin/product')
        cy.contains('Add Product').click()
        cy.get('#name_en').type('Test Product')
        cy.get('#name_th').type('ทดสอบ')
        cy.get('#price').type('250')
        cy.get('#description').type('2x2.5 kg')
        cy.get('#vat').check()
        cy.get('.btn-success').click()
        cy.contains('The name en has already been taken.')
        cy.contains('The name th has already been taken.')
    })

    it('Update product', () => {
        cy.visit('admin/product')
        cy.wait(500)
        cy.get('#dataTable_filter > label > .form-control').type('Test Product')
        cy.wait(2000)
        cy.get('.text-warning-dark > .fa-pencil').click()
        cy.get('#name_en').clear()
        cy.get('#name_en').type('Test Update')
        cy.get('.btn-success').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type('Test Product')
        cy.wait(1000)
        cy.contains('No matching records found')
    })

    it('Delete product', () => {
        cy.get('#dataTable_filter > label > .form-control').clear()
        cy.get('#dataTable_filter > label > .form-control').type('Test Update')
        cy.wait(2000)
        cy.get('.text-danger > .fa').click()
        cy.get('.swal2-confirm').click()
        cy.contains('Success')
        cy.get('.swal2-confirm').click()
        cy.get('#dataTable_filter > label > .form-control').type('Test Update')
        cy.wait(2000)
        cy.contains('No matching records found')
    })

})
