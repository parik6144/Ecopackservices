$(document).ready(function() {
    // Function to format numbers with commas and two decimal places
    function formatCurrency(num) {
        if (typeof num !== 'number' || isNaN(num)) {
            return 'N/A'; // Handle non-numeric or NaN input
        }
        return `₹ ${num.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
    }

    function calculateCTC() {
        const employeeName = $('#employeeName').val() || 'N/A';
        const designation = $('#designation').val() || 'N/A';

        // Get Monthly Gross Salary as the base
        const monthlyGrossSalary = parseFloat($('#basicSalary').val()) || 0;
        
        // Get percentage breakdowns
        const basicPercentage = parseFloat($('#basicPercentage').val()) || 50; // Get from input field
        const hraPercentage = parseFloat($('#hra').val()) || 0;
        const conveyancePercentage = parseFloat($('#conveyance').val()) || 0;
        const educationPercentage = parseFloat($('#education').val()) || 0;
        const medicalPercentage = parseFloat($('#medical').val()) || 0;
        const specialAllowancePercentage = parseFloat($('#specialAllowance').val()) || 0;

        // Calculate Basic Salary based on percentage of Gross
        const basicSalaryMonthly = monthlyGrossSalary * (basicPercentage / 100);
        
        // Calculate other components based on Basic Salary
        const hraMonthly = basicSalaryMonthly * (hraPercentage / 100);
        const conveyanceMonthly = basicSalaryMonthly * (conveyancePercentage / 100);
        const educationMonthly = basicSalaryMonthly * (educationPercentage / 100);
        const medicalMonthly = basicSalaryMonthly * (medicalPercentage / 100);
        const specialAllowanceMonthly = basicSalaryMonthly * (specialAllowancePercentage / 100);

        // Verify total equals gross salary (adjust special allowance if needed)
        const calculatedTotal = basicSalaryMonthly + hraMonthly + conveyanceMonthly + 
                               educationMonthly + medicalMonthly + specialAllowanceMonthly;
        
        // If there's a difference, adjust special allowance
        let adjustedSpecialAllowance = specialAllowanceMonthly;
        if (Math.abs(calculatedTotal - monthlyGrossSalary) > 1) {
            adjustedSpecialAllowance = monthlyGrossSalary - (basicSalaryMonthly + hraMonthly + 
                                                           conveyanceMonthly + educationMonthly + medicalMonthly);
        }

        // Annual Inputs
        const ltaAnnual = parseFloat($('#lta').val()) || 0;
        const performanceBonusAnnual = parseFloat($('#performanceBonus').val()) || 0;
        const employerPfRate = parseFloat($('#employerPfRate').val()) || 0;
        const employerEsiRate = parseFloat($('#employerEsiRate').val()) || 0;
        const gratuityRate = parseFloat($('#gratuityRate').val()) || 0;
        const healthInsurancePremiumAnnual = parseFloat($('#healthInsurancePremium').val()) || 0;
        const otherPerksAnnual = parseFloat($('#otherPerks').val()) || 0;

        // Deduction Inputs
        const employeePfRate = parseFloat($('#employeePfRate').val()) || 0;
        const employeeEsiRate = parseFloat($('#employeeEsiRate').val()) || 0;
        const professionalTaxAnnual = parseFloat($('#professionalTax').val()) || 0;
        const otherDeductionsAnnual = parseFloat($('#otherDeductions').val()) || 0;

        // --- Calculations ---

        // 2. Annual Components
        const basicSalaryAnnual = basicSalaryMonthly * 12;
        const hraAnnual = hraMonthly * 12;
        const conveyanceAnnual = conveyanceMonthly * 12;
        const educationAnnual = educationMonthly * 12;
        const medicalAnnual = medicalMonthly * 12;
        const specialAllowanceAnnual = adjustedSpecialAllowance * 12;
        const annualGrossSalary = monthlyGrossSalary * 12;

        // 3. Employer Contributions
        const pfGratuityConsiderationBasic = basicSalaryAnnual;
        const employerPfContribution = pfGratuityConsiderationBasic * (employerPfRate / 100);

        // ESI applicability: generally for employees earning up to ₹21,000 gross monthly
        let employerEsiContribution = 0;
        if (monthlyGrossSalary <= 21000) {
            employerEsiContribution = annualGrossSalary * (employerEsiRate / 100);
        }

        const gratuityContribution = pfGratuityConsiderationBasic * (gratuityRate / 100);

        // 4. Total CTC
        const totalCtc =
            basicSalaryAnnual +
            hraAnnual +
            conveyanceAnnual +
            educationAnnual +
            medicalAnnual +
            specialAllowanceAnnual +
            ltaAnnual +
            performanceBonusAnnual +
            employerPfContribution +
            employerEsiContribution +
            gratuityContribution +
            healthInsurancePremiumAnnual +
            otherPerksAnnual;

        // 5. In-Hand Salary (Net Take-Home) Deductions
        const employeePfContribution = pfGratuityConsiderationBasic * (employeePfRate / 100);
        let employeeEsiContribution = 0;
        if (monthlyGrossSalary <= 21000) {
            employeeEsiContribution = annualGrossSalary * (employeeEsiRate / 100);
        }

        const incomeTaxAnnual = 0; // Placeholder for simplicity

        const totalAnnualDeductions =
            employeePfContribution +
            employeeEsiContribution +
            professionalTaxAnnual +
            incomeTaxAnnual +
            otherDeductionsAnnual;

        const annualNetSalary = annualGrossSalary - totalAnnualDeductions;
        const monthlyNetSalary = annualNetSalary / 12;

        // Update the input field to show the calculated basic salary
        $('#basicSalary').attr('data-calculated-basic', basicSalaryMonthly.toFixed(2));

        // --- Display Results ---
        let previewHtml = `
            <div style="text-align: center; margin-bottom: 20px;">
                <h3 style="color: #2e7d32; margin-bottom: 10px;">📋 Employee Information</h3>
                <p><strong>Employee Name:</strong> <span>${employeeName}</span></p>
                <p><strong>Designation:</strong> <span>${designation}</span></p>
            </div>
            <hr>

            <p class="section-title">💰 Monthly Salary Breakdown</p>
            <p><strong>Monthly Gross Salary:</strong> <span>${formatCurrency(monthlyGrossSalary)}</span></p>
            <p>Basic Salary (${basicPercentage}%): <span>${formatCurrency(basicSalaryMonthly)}</span></p>
            <p>House Rent Allowance: <span>${formatCurrency(hraMonthly)}</span></p>
            <p>Conveyance Allowance: <span>${formatCurrency(conveyanceMonthly)}</span></p>
            <p>Education Allowance: <span>${formatCurrency(educationMonthly)}</span></p>
            <p>Medical Allowance: <span>${formatCurrency(medicalMonthly)}</span></p>
            <p>Special Allowance: <span>${formatCurrency(adjustedSpecialAllowance)}</span></p>
            <hr>

            <p class="section-title">💰 Fixed Components (Annual)</p>
            <p>Basic Salary: <span>${formatCurrency(basicSalaryAnnual)}</span></p>
            <p>House Rent Allowance: <span>${formatCurrency(hraAnnual)}</span></p>
            <p>Conveyance Allowance: <span>${formatCurrency(conveyanceAnnual)}</span></p>
            <p>Education Allowance: <span>${formatCurrency(educationAnnual)}</span></p>
            <p>Medical Allowance: <span>${formatCurrency(medicalAnnual)}</span></p>
            <p>Special Allowance: <span>${formatCurrency(specialAllowanceAnnual)}</span></p>
            <p>Leave Travel Allowance: <span>${formatCurrency(ltaAnnual)}</span></p>
            <p>Performance Bonus (Target): <span>${formatCurrency(performanceBonusAnnual)}</span></p>
            <p class="total-line"><strong>Annual Gross Salary:</strong> <span>${formatCurrency(annualGrossSalary)}</span></p>
            <hr>

            <p class="section-title">🏢 Employer Contributions (Annual)</p>
            <p>Employer PF Contribution: <span>${formatCurrency(employerPfContribution)}</span></p>
            <p>Employer ESI Contribution: <span>${formatCurrency(employerEsiContribution)}</span></p>
            <p>Gratuity Contribution: <span>${formatCurrency(gratuityContribution)}</span></p>
            <p>Health Insurance Premium (Employer): <span>${formatCurrency(healthInsurancePremiumAnnual)}</span></p>
            <p>Other Company Perks: <span>${formatCurrency(otherPerksAnnual)}</span></p>
            <hr>

            <p class="total-line"><strong>🎯 Total CTC (Cost to Company):</strong> <span>${formatCurrency(totalCtc)}</span></p>
            <hr>

            <p class="section-title">💸 Employee Deductions (Annual)</p>
            <p>Employee PF Contribution: <span>${formatCurrency(employeePfContribution)}</span></p>
            <p>Employee ESI Contribution: <span>${formatCurrency(employeeEsiContribution)}</span></p>
            <p>Professional Tax: <span>${formatCurrency(professionalTaxAnnual)}</span></p>
            <p>Income Tax (TDS Estimate): <span>To be calculated based on employee IT declaration & investments.</span></p>
            <p>Other Deductions: <span>${formatCurrency(otherDeductionsAnnual)}</span></p>
            <p class="total-line"><strong>Total Annual Deductions:</strong> <span>${formatCurrency(totalAnnualDeductions)}</span></p>
            <hr>

            <p class="total-line"><strong>💵 Annual Net Take-Home Salary:</strong> <span>${formatCurrency(annualNetSalary)}</span></p>
            <p class="total-line"><strong>💵 Monthly Net Take-Home Salary:</strong> <span>${formatCurrency(monthlyNetSalary)}</span></p>
        `;

        $('#previewData').html(previewHtml);
    }

    // Call calculateCTC on page load to show initial values
    calculateCTC();

    // Attach event listener to all input fields to trigger recalculation on change
    $('#ctcForm input').on('input', calculateCTC);

    // --- Enhanced PDF Generation Logic ---
    $('#generatePdf').on('click', function() {
        const button = $(this);
        const originalText = button.text();
        
        // Add loading state
        button.addClass('loading').text('Generating PDF...').prop('disabled', true);

        try {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'mm', 'a4');

            // Get current data for PDF
            const employeeName = $('#employeeName').val() || 'N/A';
            const designation = $('#designation').val() || 'N/A';
            
            // Get the preview content
            const previewContent = document.getElementById('previewData');

            // Create a temporary container for PDF content
            const tempContainer = document.createElement('div');
            tempContainer.style.cssText = `
                position: absolute;
                left: -9999px;
                top: -9999px;
                width: 800px;
                background: white;
                padding: 40px;
                font-family: Arial, sans-serif;
                font-size: 12px;
                line-height: 1.4;
            `;
            tempContainer.innerHTML = previewContent.innerHTML;
            document.body.appendChild(tempContainer);

            html2canvas(tempContainer, {
                scale: 2,
                useCORS: true,
                allowTaint: true,
                backgroundColor: '#ffffff',
                width: 800,
                height: tempContainer.scrollHeight,
                scrollX: 0,
                scrollY: 0
            }).then(canvas => {
                // Remove temporary container
                document.body.removeChild(tempContainer);

                const imgData = canvas.toDataURL('image/png', 1.0);
                const pdfWidth = doc.internal.pageSize.getWidth();
                const pdfHeight = doc.internal.pageSize.getHeight();
                const imgWidth = pdfWidth - 20; // 10mm margin on each side
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                // Add header with green color
                doc.setFillColor(76, 175, 80);
                doc.rect(0, 0, pdfWidth, 30, 'F');
                
                // Add logo placeholder
                doc.setFillColor(255, 255, 255);
                doc.rect(10, 5, 20, 20, 'F');
                doc.setTextColor(255, 255, 255);
                doc.setFontSize(16);
                doc.setFont('helvetica', 'bold');
                doc.text('Ecopack Services', pdfWidth / 2, 12, { align: 'center' });
                doc.setFontSize(12);
                doc.text('CTC Calculator Report', pdfWidth / 2, 22, { align: 'center' });

                // Reset text color for content
                doc.setTextColor(0, 0, 0);
                doc.setFont('helvetica', 'normal');

                let heightLeft = imgHeight;
                let position = 35; // Start below header

                // Add content
                doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);

                // Handle multiple pages if content is long
                heightLeft -= (pdfHeight - position);

                while (heightLeft > 0) {
                    position = -heightLeft + 10;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                    heightLeft -= pdfHeight;
                }

                // Add footer to all pages
                const totalPages = doc.internal.getNumberOfPages();
                for (let i = 1; i <= totalPages; i++) {
                    doc.setPage(i);
                    doc.setFontSize(8);
                    doc.setTextColor(100);
                    doc.text(`Page ${i} of ${totalPages}`, pdfWidth - 25, pdfHeight - 10, { align: 'right' });
                    doc.text(`Generated on: ${new Date().toLocaleDateString('en-IN')} at ${new Date().toLocaleTimeString('en-IN')}`, 10, pdfHeight - 10);
                }

                // Generate filename
                const timestamp = new Date().toISOString().slice(0, 10);
                const filename = `Ecopack_CTC_Report_${employeeName.replace(/[^a-zA-Z0-9]/g, '_')}_${timestamp}.pdf`;

                // Save PDF
                doc.save(filename);

                // Show success message
                showNotification('PDF generated successfully!', 'success');
                
            }).catch(error => {
                console.error('Error generating PDF:', error);
                showNotification('Error generating PDF. Please try again.', 'error');
            }).finally(() => {
                // Remove loading state
                button.removeClass('loading').text(originalText).prop('disabled', false);
            });

        } catch (error) {
            console.error('PDF generation failed:', error);
            showNotification('PDF generation failed. Please check if all libraries are loaded.', 'error');
            button.removeClass('loading').text(originalText).prop('disabled', false);
        }
    });

    // Notification function
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        $('.notification').remove();
        
        const notification = $(`
            <div class="notification ${type}" style="
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 8px;
                color: white;
                font-weight: 500;
                z-index: 10000;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transform: translateX(100%);
                transition: transform 0.3s ease;
                max-width: 300px;
            ">
                ${message}
            </div>
        `);
        
        // Set background color based on type
        const colors = {
            success: '#4caf50',
            error: '#f44336',
            info: '#2196f3'
        };
        
        notification.css('background-color', colors[type] || colors.info);
        
        $('body').append(notification);
        
        // Animate in
        setTimeout(() => {
            notification.css('transform', 'translateX(0)');
        }, 100);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.css('transform', 'translateX(100%)');
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }

    // Add some interactive features
    $('.input-group input').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        $(this).parent().removeClass('focused');
    });

    // Add keyboard shortcuts
    $(document).on('keydown', function(e) {
        // Ctrl/Cmd + Enter to generate PDF
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            $('#generatePdf').click();
        }
    });
});