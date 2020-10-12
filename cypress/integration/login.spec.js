describe('Authentication', () => {
    beforeEach(() => {
        cy.visit('/')
    })

    it('switch language', () => {
        cy.clearCookies()
        cy.visit('/')

        cy.contains('Thai').click()
        cy.contains('เข้าสู่ระบบ')
        cy.contains('English').click()
        cy.contains('Login')
    })

    it('Sign in with wrong account [Eng]', () => {
        cy.contains('English').click()
        cy.contains('Login')
        cy.get('input[name="email"]').clear()
        cy.get('input[name="email"]').type('test@test.com')
        cy.get('input[name="password"]').clear()
        cy.get('input[name="password"]').type('password')
        cy.get('button[type="submit"]').click()
        cy.contains('These credentials do not match our records')
    })

    it('Sign in with wrong account [Thai]', () => {
        cy.contains('Thai').click()
        cy.contains('เข้าสู่ระบบ')
        cy.get('input[name="email"]').clear()
        cy.get('input[name="email"]').type('test@test.com')
        cy.get('input[name="password"]').clear()
        cy.get('input[name="password"]').type('password')
        cy.get('button[type="submit"]').click()
        cy.contains('ข้อมูลที่ใช้ในการยืนยันตัวตนไม่ถูกต้อง')
    })

    it('Sign in with right account', () => {
        cy.get('input[name="email"]').clear()
        cy.get('input[name="email"]').type('admin@admin.com')
        cy.get('input[name="password"]').clear()
        cy.get('input[name="password"]').type('password')
        cy.get('button[type="submit"]').click()
        cy.url().should('include', '/dashboard')
    })

})
