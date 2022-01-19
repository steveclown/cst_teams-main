DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    TRIGGER `cst_teams`.`after_insert_employeedata_to_alteration` AFTER INSERT
    ON `cst_teams`.`hro_employee_data`
    FOR EACH ROW BEGIN
    INSERT INTO hro_employee_status_alteration (employee_id, applicant_id, marital_status_id, region_id, branch_id,
    company_id, division_id, department_id, section_id, unit_id, job_title_id, grade_id, class_id, location_id, bank_id,
    status_alteration_date, status_alteration_last_date, employee_employment_status)
    VALUES (new.employee_id, new.applicant_id, new.marital_status_id, new.region_id, new.branch_id,
    new.company_id, new.division_id, new.department_id, new.section_id, new.unit_id, new.job_title_id, new.grade_id, new.class_id,
    new.location_id, new.bank_id, NOW(), NOW(), new.employee_employment_status);
    END$$

DELIMITER ;