<?php
session_start();

// If the user is not logged in, redirect to the login page with an error message
if (!isset($_SESSION['user_id'])) {
    $_SESSION['login_errors'] = ["Please log in to access the dashboard."];
    header('Location: login.php');
    exit();
}

$page_title = 'Investor Dashboard - Flix9 Hub';
$page_css = ['css/pages.css'];
include 'includes/header.php';
require 'includes/data.php'; // Include the dummy data

// Welcome the user
$fullname = $_SESSION['user_fullname'] ?? 'Investor';
?>

    <main class="page-content">
        <section class="dashboard-header">
            <h2>Welcome, <?php echo htmlspecialchars($fullname); ?>!</h2>
            <p>This is your central hub for managing your investments and exploring new opportunities.</p>
        </section>

        <section class="dashboard-actions" style="margin-top: 2rem; text-align: center;">
            <a href="#" class="btn">Raise a Support Ticket</a>
            <a href="#" class="btn">Download Investment Agreement</a>
        </section>

        <section class="investments-section" style="margin-top: 2rem;">
            <h3>Upcoming Projects for Investment</h3>
            <div class="trailer-grid">

                <?php if (empty($upcoming_projects)): ?>
                    <p>There are no upcoming projects available for investment at the moment. Please check back later.</p>
                <?php else: ?>
                    <?php foreach ($upcoming_projects as $project): ?>
                        <div class="trailer-item">
                            <img src="<?php echo htmlspecialchars($project['poster_path']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?> Poster" style="width:100%; border-radius: 5px;">
                            <div class="investment-snippet">
                                <p><?php echo htmlspecialchars($project['hot_deal_snippet']); ?></p>
                            </div>
                            <div class="investment-description">
                                <p><strong>🎥 Title:</strong> <?php echo htmlspecialchars($project['title']); ?><br>
                                   <strong>🌟 Cast:</strong> <?php echo htmlspecialchars($project['cast']); ?><br>
                                   <strong>📺 OTT Rights | Tamil Language</strong></p>
                                <ul>
                                    <li><strong>💰 Earn <?php echo htmlspecialchars($project['returns']); ?> Returns Every Month</strong></li>
                                    <li><strong>⏳ Tenure:</strong> <?php echo htmlspecialchars($project['tenure']); ?></li>
                                    <li><strong>💵 Minimum Investment:</strong> <?php echo htmlspecialchars($project['min_investment']); ?></li>
                                    <li><strong>⚙️ Asset Management Fee:</strong> <?php echo htmlspecialchars($project['asset_fee']); ?></li>
                                </ul>
                                <div style="text-align: center; margin-top: 1rem;">
                                    <button class="btn" onclick="location.href='invest.php?project_id=<?php echo $project['id']; ?>'">Invest Now</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </section>

        <section class="my-investments-section" style="margin-top: 2rem;">
            <h3>My Investments</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Project Title</th>
                            <th>Amount Invested</th>
                            <th>Monthly Returns</th>
                            <th>Status / Performance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- This is placeholder data. It will be dynamic later. -->
                        <tr>
                            <td>Project Alpha</td>
                            <td>₹1,00,000</td>
                            <td>+ ₹7,500 (July)</td>
                            <td style="color: #28a745;">Performing Well</td>
                            <td>
                                <button class="btn-small">Extend</button>
                                <button class="btn-small btn-danger">Withdraw</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Project Gamma (Old)</td>
                            <td>₹50,000</td>
                            <td>-</td>
                            <td style="color: #ffc107;">Completed</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

<?php include 'includes/footer.php'; ?>
